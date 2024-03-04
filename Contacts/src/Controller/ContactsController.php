<?php

namespace Croogo\Contacts\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Croogo\Contacts\Model\Entity\Message;
use Croogo\Core\Croogo;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use DateTime;
use Croogo\Core\Controller\Admin\ResultsController;


/**
 * Class ContactsController
 */
class ContactsController extends AppController
{

    private $pSalt = '+R*e!2$A-';
    protected $pAmount = 0;

    public function initialize()
    {
        parent::initialize();

        $this->_loadCroogoComponents([
            'Akismet',
            'Recaptcha' => [
                'actions' => ['view']
            ]
        ]);
    }

    /**
     * View
     *
     * @param string $alias
     * @return \Cake\Http\Response|void
     * @throws NotFoundException
     */
    public function view($alias = null)
    {
        if (!$alias) { //If $alias is not provided, it defaults to 'contact'
            $alias = 'contact';
        }
        $contact = $this->Contacts->find()
            ->where([ //It retrieves a contact record from the database using the Contacts model based on the $alias and a status of 1
                'alias' => $alias,
                'status' => 1,
            ])
            ->firstOrFail(); //If no contact is found, it throws an exception

        $continue = true;
        if (!$contact->message_status) {
            $continue = false;
        }

        $message = $this->Contacts->Messages->newEntity(); //A new message entity is created using the Messages model.



        if ($this->getRequest()->is('post') && $continue === true) {
            $message = $this->Contacts->Messages->patchEntity($message, $this->getRequest()->data); //The message entity is populated with data from the request (patchEntity())
            $message->contact_id = $contact->id; //is set to the ID of the retrieved contact
            Croogo::dispatchEvent('Controller.Contacts.beforeMessage', $this);

            $continue = $this->_spamProtection($continue, $contact, $message);
            $continue = $this->_captcha($continue, $contact, $message);
            $continue = $this->_validation($continue, $contact, $message);
            // $continue = $this->_sendEmail($continue, $contact, $message);
            $this->set(compact('continue'));

            $captchaSecret = Configure::read('Service.recaptcha_private_key');
            if ($this->request->is('post')) {
                $request_data = $this->request->getData();
                if ($request_data['g-recaptcha-response']) {
                    $recaptcha = $this->request->getData('g-recaptcha-response');
                    $secret = $captchaSecret;
                    $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}";
                    $response = file_get_contents($url);
                    $response_keys = json_decode($response, true);
                    if ($response_keys['success']) {
                        if ($continue === true) {
                            $this->Contacts->Messages->save($message);
                            Croogo::dispatchEvent('Controller.Contacts.afterMessage', $this);
                            $this->Flash->success(__d('croogo', 'Your message has been received...'));
                            return $this->redirect($this->referer());
                        }
                    } else {
                        $this->Flash->error('Failed to verify as not a robot.');
                        $this->Croogo->viewFallback([
                            'view_' . $contact->id,
                            'view_' . $contact->alias,
                        ]);
                        $this->set('contact', $contact);
                        $this->set('message', $message);
                    }
                } else {
                    $this->Flash->error("Please verify that you're not a robot.");
                    $this->Croogo->viewFallback([
                        'view_' . $contact->id,
                        'view_' . $contact->alias,
                    ]);
                    $this->set('contact', $contact);
                    $this->set('message', $message);
                }
            }
        }

        $this->Croogo->viewFallback([
            'view_' . $contact->id,
            'view_' . $contact->alias,
        ]);
        $this->set('contact', $contact);
        $this->set('message', $message);
    }

    /**
     * Validation
     *
     * @param bool $continue
     * @param array $contact
     * @return bool
     * @access protected
     */
    protected function _validation($continue, $contact, Message $message)
    {
        if ($message->errors() || $continue === false) {
            return false;
        }

        if ($contact->message_archive && !$this->Contacts->Messages->save($message)) {
            return false;
        }

        return $continue;
    }

    /**
     * Spam protection
     *
     * @param bool $continue
     * @param array $contact
     * @return bool
     * @access protected
     */
    protected function _spamProtection($continue, $contact, Message $message)
    {
        if (!$contact->message_spam_protection || $continue === false) {
            return $continue;
        }
        $this->Akismet->setCommentAuthor($message->name);
        $this->Akismet->setCommentAuthorEmail($message->email);
        $this->Akismet->setCommentContent($message->body);
        if ($this->Akismet->isCommentSpam()) {
            $this->Flash->error(__d('croogo', 'Sorry, the message appears to be spam.'));

            return false;
        }

        return true;
    }

    /**
     * Captcha
     *
     * @param bool $continue
     * @param array $contact
     * @return bool
     * @access protected
     */
    protected function _captcha($continue, $contact, Message $message)
    {
        if (!$contact->message_captcha || $continue === false) {
            return $continue;
        }

        if (!$this->Recaptcha->verify()) {
            $this->Flash->error(__d('croogo', 'Invalid captcha entry'));

            return false;
        }

        return true;
    }

    /**
     * Send Email
     *
     * @param bool $continue
     * @param array $contact
     * @return bool
     * @access protected
     */
    protected function _sendEmail($continue, $contact, Message $message)
    {
        if (!$contact->message_notify || $continue === false) {
            return $continue;
        }
        $email = new Email();
        $siteTitle = Configure::read('Site.title');
        try {
            $email->from($message->email)
                ->to($contact->email)
                ->subject(__d('croogo', '[%s] %s', $siteTitle, $contact->title))
                ->template('Croogo/Contacts.contact')
                ->viewVars([
                    'contact' => $contact,
                    'message' => $message,
                ]);
            if ($this->viewBuilder()->getTheme()) {
                $email->theme($this->viewBuilder()->getTheme());
            }
            if (!$email->send()) {
                $continue = false;
            }
        } catch (SocketException $e) {
            $this->log(sprintf('Error sending contact notification: %s', $e->getMessage()));
            $continue = false;
        }
        return $continue;
    }

    public function employeesList($slug)
    {
        $rolesTable = TableRegistry::getTableLocator()->get('roles');
        $usersTable = TableRegistry::getTableLocator()->get('users');

        // Find the role based on the alias
        $role = $rolesTable->find()
            ->where(['alias' => $slug])
            ->first();

        if ($role) {
            $query = $usersTable->find()
                ->select([
                    'employee_id' => "emp.employee_id",
                    'employee_name' => "emp.name",
                    'image_name' => "emp.image_name",
                    'role_title' => "role.title",
                    'designation_title' => "designation.name",
                ])
                ->join([
                    'emp' => [
                        'table' => 'employee',
                        'type' => 'LEFT',
                        'conditions' => [
                            'emp.user_id = users.id',
                        ]
                    ],
                    'role' => [
                        'table' => 'roles',
                        'type' => 'LEFT',
                        'conditions' => [
                            'role.id = users.role_id',
                        ]
                    ],
                    'designation' => [
                        'table' => 'employees_designation',
                        'type' => 'LEFT',
                        'conditions' => [
                            'designation.id = emp.employees_designation_id',
                        ]
                    ],
                ])
                ->where([
                    'role_id' => $role->id,
                    'role.id !=' => 1,
                ]);

            $count = $query->count();
            $employees = $query->toArray();
        } else {
            $count = 0;
            $employees = [];
        }

        $this->set('count', $count);
        $this->set('employees', $employees);
        $this->set('role', $role);
    }



    public function employeesProfile($id)
    {
        $getProfile = TableRegistry::getTableLocator()->get('employee');
        $profiles = $getProfile->find()
            ->where(['employee_id' => $id])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->select([
                'designation_name' => "d.name",
            ])
            ->join([
                'd' => [
                    'table' => 'employees_designation',
                    'type' => 'LEFT',
                    'conditions' => [
                        'd.id = employee.employees_designation_id '
                    ]
                ],
            ])
            ->toArray();
        $this->set('profiles', $profiles);
    }



    public function gallery()
    {
        $albumsTable = TableRegistry::getTableLocator()->get('cms_album');
        $albums = $albumsTable->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('albums', $albums);

        // WILL WORK LATER FOR THE COUNT AS CHALLANGE
        $get_photos = TableRegistry::getTableLocator()->get('cms_photos'); //Execute First
        $photos = $get_photos->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('photos', $photos);


        $count = count($photos);
        $this->set('count', $count);
    }



    public function viewPhotos($id)
    {
        $get_photos = TableRegistry::getTableLocator()->get('cms_photos'); //Execute First
        $photos = $get_photos->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->order('cms_photos.photo_id ASC')
            ->select(['album_title' => 'ap.album_title', 'description' => 'ap.description'])
            ->join([
                'ap' => [
                    'table' => 'cms_album',
                    'type' => 'LEFT',
                    'conditions' => ['ap.album_id = cms_photos.album_id'],
                ]
            ])
            ->where(['cms_photos.album_id' => $id])
            ->toArray();
        $this->set('photos', $photos);
    }



    public function search()
    {
        $this->set('title_for_layout', __('Admission Form Search'));
        $this->layout = 'admission-form';
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            if (!empty($request_data['roll'])) {

                $roll = $this->request->data['roll'];
                $student = TableRegistry::getTableLocator()->get('temp_students'); //Execute First
                $students = $student
                    ->find()
                    ->where(['temp_students.roll' => $roll])
                    ->toArray();
                if (!empty($students[0]['session'])) {
                    $student = TableRegistry::getTableLocator()->get('temp_students'); //Execute First
                    $students = $student
                        ->find()
                        ->where(['temp_students.roll' => $roll])
                        ->where(['temp_students.session' => $students[0]['session']])
                        ->toArray();
                    $this->set('stu', $students[0]);
                }
            }
        }
    }




    public function index()
    {
        $this->set('title_for_layout', __('Admission Form Search'));
        $this->layout = 'report';
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            if (!empty($request_data['roll'])) {

                $roll = $this->request->data['roll'];
                $student = TableRegistry::getTableLocator()->get('temp_students'); //Execute First
                $students = $student
                    ->find()
                    ->where(['temp_students.roll' => $roll])
                    ->toArray();
                $this->set('stu', $students[0]);
            } else {
                $request_data = $this->request->getData();
                $file = $request_data['image_name'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                $thumbnailFileName = null;
                $regularSizeFileName = null;

                if (in_array($ext, $arr_ext)) {
                    // Move uploaded file to original folder
                    $originalFolderPath = WWW_ROOT . '/uploads/students/large_version/'; // Specify original folder path
                    if (!file_exists($originalFolderPath)) {
                        mkdir($originalFolderPath, 0777, true);
                    }
                    $originalImagePath = $originalFolderPath . $setNewFileName . '.' . $ext;
                    move_uploaded_file($file['tmp_name'], $originalImagePath);

                    // Open original image file
                    $image = null;
                    if ($ext == 'jpg' || $ext == 'jpeg') {
                        $image = imagecreatefromjpeg($originalImagePath);
                    } else if (
                        $ext == 'png'
                    ) {
                        $image = imagecreatefrompng($originalImagePath);
                    }

                    // Compress image and save thumbnail version
                    if ($image) {
                        $thumbnailFolderPath = WWW_ROOT . '/uploads/students/thumbnail/'; // Specify thumbnail folder path
                        if (!file_exists($thumbnailFolderPath)) {
                            mkdir($thumbnailFolderPath, 0777, true);
                        }
                        $thumbnailImagePath = $thumbnailFolderPath . $setNewFileName . '_th.' . $ext;
                        $thumbnailWidth = 300; // Change this value to adjust thumbnail width
                        $thumbnailHeight = 300; // Change this value to adjust thumbnail height
                        $thumbnailImage = imagescale($image, $thumbnailWidth, $thumbnailHeight);
                        imagejpeg($thumbnailImage, $thumbnailImagePath, 50);
                        $thumbnailFileName = $setNewFileName . '_th.' . $ext;
                        imagedestroy($thumbnailImage);
                    }


                    // Delete original image
                    unlink($originalImagePath);
                }
                $request_data['thumbnail'] = $thumbnailFileName;
                $student_data['id'] = $request_data['id'];
                $student_data['bn_name'] = $request_data['bn_name'];
                $student_data['mobile'] = $request_data['mobile'];
                $student_data['dob'] = $request_data['dob'];
                $student_data['permanent_address'] = $request_data['permanent_address'];
                $student_data['current_address'] = $request_data['present_address'];
                $student_data['gender'] = $request_data['gender'];
                $student_data['religion'] = $request_data['religion'];
                $student_data['bn_fname'] = $request_data['bn_fname'];
                $student_data['fname'] = $request_data['fname'];
                $student_data['fmobile'] = $request_data['fmobile'];
                $student_data['f_nid'] = $request_data['f_nid'];
                $student_data['foccupation'] = $request_data['foccupation'];
                $student_data['foccupation_type'] = $request_data['foccupation_type'];
                $student_data['fincome'] = $request_data['fincome'];

                $student_data['bn_mname'] = $request_data['bn_mname'];
                $student_data['mname'] = $request_data['mname'];
                $student_data['mmobile'] = $request_data['mmobile'];
                $student_data['m_nid'] = $request_data['m_nid'];
                $student_data['moccupation'] = $request_data['moccupation'];
                $student_data['moccupation_type'] = $request_data['moccupation_type'];
                $student_data['mincome'] = $request_data['mincome'];

                $student_data['pre_school'] = $request_data['pre_school'];
                $student_data['session'] = $request_data['session'];
                $student_data['status'] = $request_data['status'];
                $student_data['thumbnail'] = $request_data['thumbnail'];

                $session = intval(substr($student_data['session'], -2));

                $serial = $session . '0' . 3 . $student_data['id'];
                $student_data['serial'] = $serial;

                $students = TableRegistry::getTableLocator()->get('temp_students');
                $query = $students->query();
                $query->update()
                    ->set($student_data)
                    ->where(['id' => $student_data['id']])
                    ->execute();
                $students = TableRegistry::getTableLocator()->get('temp_students');
                $student = $students
                    ->find()
                    ->where(['id' => $student_data['id']])
                    ->toArray();

                $this->set('stu', $student[0]);
                $this->render('/Contacts/view');
            }
        }
    }



    public function tform($id)
    {

        $this->layout = 'admission-form';
        $this->set('title_for_layout', __('Admission Form Submission'));
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $file = $request_data['image_name'];
            $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = time() . "_" . rand(000000, 999999);

            $thumbnailFileName = null;
            $regularSizeFileName = null;

            if (in_array($ext, $arr_ext)) {
                // Move uploaded file to original folder
                $originalFolderPath = WWW_ROOT . '/uploads/students/large_version//'; // Specify original folder path
                if (!file_exists($originalFolderPath)) {
                    mkdir($originalFolderPath, 0777, true);
                }
                $originalImagePath = $originalFolderPath . $setNewFileName . '.' . $ext;
                move_uploaded_file($file['tmp_name'], $originalImagePath);

                // Open original image file
                $image = null;
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $image = imagecreatefromjpeg($originalImagePath);
                } else if (
                    $ext == 'png'
                ) {
                    $image = imagecreatefrompng($originalImagePath);
                }

                // Compress image and save thumbnail version
                if ($image) {
                    $thumbnailFolderPath = WWW_ROOT . '/uploads/students/thumbnail/'; // Specify thumbnail folder path
                    if (!file_exists($thumbnailFolderPath)) {
                        mkdir($thumbnailFolderPath, 0777, true);
                    }
                    $thumbnailImagePath = $thumbnailFolderPath . $setNewFileName . '_th.' . $ext;
                    $thumbnailWidth = 300; // Change this value to adjust thumbnail width
                    $thumbnailHeight = 300; // Change this value to adjust thumbnail height
                    $thumbnailImage = imagescale($image, $thumbnailWidth, $thumbnailHeight);
                    imagejpeg($thumbnailImage, $thumbnailImagePath, 50);
                    $thumbnailFileName = $setNewFileName . '_th.' . $ext;
                    imagedestroy($thumbnailImage);
                }

                // Delete original image
                unlink($originalImagePath);
            }
            $request_data['thumbnail'] = $thumbnailFileName;
            $student_data['name'] = $request_data['name'];
            $student_data['bn_name'] = $request_data['bn_name'];
            $student_data['mobile'] = $request_data['mobile'];
            $student_data['dob'] = $request_data['dob'];
            $student_data['birth_reg'] = $request_data['birth_reg'];
            $student_data['permanent_address'] = $request_data['permanent_address'];
            $student_data['current_address'] = $request_data['present_address'];
            $student_data['gender'] = $request_data['gender'];
            $student_data['religion'] = $request_data['religion'];
            $student_data['bn_fname'] = $request_data['bn_fname'];
            $student_data['fname'] = $request_data['fname'];
            $student_data['fmobile'] = $request_data['fmobile'];
            $student_data['f_nid'] = $request_data['f_nid'];
            $student_data['foccupation'] = $request_data['foccupation'];
            $student_data['foccupation_type'] = $request_data['foccupation_type'];
            $student_data['fincome'] = $request_data['fincome'];

            $student_data['bn_mname'] = $request_data['bn_mname'];
            $student_data['mname'] = $request_data['mname'];
            $student_data['mmobile'] = $request_data['mmobile'];
            $student_data['m_nid'] = $request_data['m_nid'];
            $student_data['moccupation'] = $request_data['moccupation'];
            $student_data['moccupation_type'] = $request_data['moccupation_type'];
            $student_data['mincome'] = $request_data['mincome'];

            $student_data['pre_school'] = $request_data['pre_school'];
            $student_data['session'] = $request_data['session'];
            $student_data['shift'] = $request_data['shift'];
            $student_data['level'] = $request_data['level'];
            $student_data['quota'] = $request_data['quota'];
            $student_data['status'] = $request_data['status'];
            $student_data['thumbnail'] = $request_data['thumbnail'];

            $session = intval(substr($student_data['session'], -2));

            if ($id != null) {
                $serial = $session . '0' . '3' . $id;
                $student_data['serial'] = $serial;
            }

            foreach ($student_data as $key => $data) {
                if ($data == '-- Choose --') {
                    $student_data[$key] = null;
                }
            }

            $student = TableRegistry::getTableLocator()->get('temp_students');
            $query = $student->query();
            $query->insert([
                'name', 'bn_name', 'mobile', 'dob', 'birth_reg', 'permanent_address', 'current_address', 'gender',
                'religion', 'bn_fname', 'fname', 'fmobile', 'f_nid', 'foccupation', 'foccupation_type', 'fincome',
                'bn_mname', 'mname', 'mmobile', 'm_nid', 'moccupation', 'moccupation_type', 'mincome',
                'thumbnail', 'serial', 'shift', 'level', 'session'
            ])
                ->values($student_data)
                ->execute();
            $this->set('stu', $student_data);
            $this->render('/Contacts/view');
        }
        $student = TableRegistry::getTableLocator()->get('temp_students');
        $students = $student
            ->find()
            ->where(['id' => $id])
            ->toArray();
        $this->set('stu', $students[0]);
        $session = TableRegistry::getTableLocator()->get('scms_sessions');
        $sessions = $session
            ->find()
            ->toArray();
        $this->set('sessions', $sessions);

        $level = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $level
            ->find()
            ->toArray();
        $this->set('levels', $levels);
        $group = TableRegistry::getTableLocator()->get('scms_groups');
        $groups = $group
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('groups', $groups);
        $shift = TableRegistry::getTableLocator()->get('hr_shift');
        $shifts = $shift
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('shifts', $shifts);
    }



    public function admissionform($id = null)
    {
        $this->layout = 'report';
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $file = $request_data['image_name'];
            $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
            $arr_ext = array('jpg', 'jpeg', 'png'); //set allowed extensions
            $setNewFileName = time() . "_" . rand(000000, 999999);

            $thumbnailFileName = null;
            $regularSizeFileName = null;

            if (in_array($ext, $arr_ext)) {
                // Move uploaded file to original folder
                $originalFolderPath = WWW_ROOT . '/uploads/students/large_version/'; // Specify original folder path
                if (!file_exists($originalFolderPath)) {
                    mkdir($originalFolderPath, 0777, true);
                }
                $originalImagePath = $originalFolderPath . $setNewFileName . '.' . $ext;
                move_uploaded_file($file['tmp_name'], $originalImagePath);

                // Open original image file
                $image = null;
                if ($ext == 'jpg' || $ext == 'jpeg') {
                    $image = imagecreatefromjpeg($originalImagePath);
                } else if (
                    $ext == 'png'
                ) {
                    $image = imagecreatefrompng($originalImagePath);
                }

                // Compress image and save thumbnail version
                if ($image) {
                    $thumbnailFolderPath = WWW_ROOT . '/uploads/students/thumbnail/'; // Specify thumbnail folder path
                    if (!file_exists($thumbnailFolderPath)) {
                        mkdir($thumbnailFolderPath, 0777, true);
                    }
                    $thumbnailImagePath = $thumbnailFolderPath . $setNewFileName . '_th.' . $ext;
                    $thumbnailWidth = 300; // Change this value to adjust thumbnail width
                    $thumbnailHeight = 300; // Change this value to adjust thumbnail height
                    $thumbnailImage = imagescale($image, $thumbnailWidth, $thumbnailHeight);
                    imagejpeg($thumbnailImage, $thumbnailImagePath, 50);
                    $thumbnailFileName = $setNewFileName . '_th.' . $ext;
                    imagedestroy($thumbnailImage);
                }


                // Delete original image
                unlink($originalImagePath);
            }
            $request_data['thumbnail'] = $thumbnailFileName;

            if (!empty($request_data)) {
                $student_data['name'] = $request_data['name'];
                $student_data['level'] = $request_data['level'];
                $student_data['quota'] = $request_data['quota'];
                $student_data['version'] = $request_data['version'];
                $student_data['fname'] = $request_data['fname'];
                $student_data['mname'] = $request_data['mname'];
                $student_data['shift'] = $request_data['shift'];
                $student_data['session'] = date("Y");
                $student_data['location'] = $request_data['location'];
                $student_data['mobile'] = $request_data['mobile'];
                $student_data['dob'] = $request_data['dob'];
                $student_data['photo'] = $request_data['thumbnail'];

                foreach ($student_data as $key => $data) {
                    if ($data == '-- Choose --') {
                        $student_data[$key] = null;
                    }
                }

                $student = TableRegistry::getTableLocator()->get('admissions');
                $query = $student->query();
                $query->insert([
                    'name', 'level', 'quota', 'shift', 'session', 'version', 'fname', 'mname', 'location', 'photo',
                    'mobile', 'dob'
                ])
                    ->values($student_data)
                    ->execute();

                $student_record = $student->find()->last(); //get the last employee id
                $newAdmissionId = $student_record->id;
                $REF['ref'] = $this->generateRefNum($student_data['session'], $student_data['level'], $newAdmissionId);
                $student = TableRegistry::getTableLocator()->get('admissions');
                $query = $student->query();
                $query->update()
                    ->set($REF)
                    ->where(['id' => $newAdmissionId])
                    ->execute();

                $token = sha1($newAdmissionId . $this->pSalt . $REF['ref']);
                $_SESSION['token'] = $token;
                $_SESSION['data'] = [
                    'id' => $newAdmissionId,
                    'ref' => $REF
                ];
                $this->redirect(array('action' => 'payment', $token));
            } else {
                $this->Flash->error('Failed to verify as not a robot.');
                return;
            }
        }
        $level = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $level
            ->find('all')
            ->toArray();
        $this->set('levels', $levels);
        $shift = TableRegistry::getTableLocator()->get('hr_shift');
        $shifts = $shift
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('shifts', $shifts);
    }



    public function payment($token = null)
    {
        $this->layout = 'no_sidebar';
        if (!empty($token)) {

            if (($green = $_SESSION) && !empty($green['token']) && !empty($green['data']['id']) && !empty($green['data']['ref']['ref']) && ($token2 = sha1($green['data']['id'] . $this->pSalt . $green['data']['ref']['ref'])) && $token == $token2 && $token == $green['token']
            ) {
                $this->loadModel('admissions');
                $user = $this->admissions->find('all')->where(['id' => $green['data']['id']])->first();
                $this->set('newAdmitter', $user);
            } else {
                $this->Session->setFlash('Invalid session!');
            }
        }
    }



    public function admitcard($token = null)
    {
        $this->layout = 'result';

        if (!empty($this->request->data)) {
            $session = date('Y');

            $REF = trim($this->request->data['ref']);
            $trxId = trim($this->request->data['Payment']['trxId']);

            if ($REF && $trxId) {

                $student = TableRegistry::getTableLocator()->get('admissions');
                $students = $student
                    ->find()
                    ->where(['ref' => $REF])
                    ->where(['session' => $session])
                    ->select([
                        'trxId' => 'c.trxId',
                        'ref_proxy' => 'c.ref_proxy',
                        'amount' => 'c.amount',
                        'pay_media' => 'c.pay_media',
                    ])
                    ->join([
                        'c' => [
                            'table' => 'payments',
                            'type' => 'LEFT',
                            'conditions' => ['c.ref_proxy = admissions.ref'],
                        ],
                    ])
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->toArray();
                $this->set('admitter', $students);

                if (empty($students)) {
                    $validationErrors['pErr'] = 'The reference number doesn\'t exist!!';
                } elseif (!empty($students[0]['payment_id'])) {
                    //Already verified:
                    if (($students[0]['level'] >= 3) && ($students[0]['level'] <= 9)) {
                        $this->pAmount = 300;
                    } else {
                        $this->pAmount = 200;
                    }

                    if ($students[0]['trxId'] != $trxId) {
                        $validationErrors['pErr'] = 'The reference or the transaction number is not correct!';
                    } elseif ($students[0]['status'] != 'Applied') {
                        $this->set('admitter', $students[0]);
                        return;
                    } else {
                        //we never should be here, though create a msg!
                        $validationErrors['pErr'] = 'System Error!';
                    }
                } else {

                    $response = $this->verifyPaymentResponse($trxId, $REF);

                    if ($response && !empty($response['transaction'])) {
                        if ($response['transaction']['trxStatus'] == '0000') {
                            if ($response['transaction']['reference'] == $REF) {
                                if ($response['transaction']['amount'] >= $this->pAmount) {
                                    $rollFeild = 'class_' . $students[0]['level'];
                                    $rollRow = TableRegistry::getTableLocator()->get('admission_rolls');
                                    $rollRows = $rollRow
                                        ->find()
                                        ->where([$rollFeild => 0])
                                        ->enableAutoFields(true)
                                        ->enableHydration(false)
                                        ->toArray();

                                    if (empty($rollRows)) {
                                        $validationErrors['pErr'] = 'System Error !!!';
                                        $dataSource->rollback(); //din
                                        $this->set(compact('validationErrors'));
                                        return;
                                    }

                                    //Don't Save the proxy (if any) for the 2nd time:

                                    if (!empty($response['transaction']['proxy_id'])) {
                                        $pStatus = true;
                                        $newPaymentId = $response['transaction']['proxy_id'];
                                        //                                         pr($newPaymentId); die;
                                    } else {
                                        $payment['trxId'] = $response['name'];
                                        $payment['ref_proxy'] = $response['ref_proxy'];
                                        $payment['amount'] = $response['amount'];
                                        $payment['sender'] = $response['sender'];
                                        $payment['receiver'] = $response['receiver'];
                                        $payment['pay_date'] = date('Y-m-d H:i:s', strtotime($response['transaction']['trxTimestamp']));
                                        $payment['payment_type_id'] = 1; //Admission|mFee
                                        $payment['pay_media'] = 3; //'Cash'|'bKash'|'Rocket'
                                        $payment['created'] = date('Y-m-d H:i:s');
                                        $payment['status'] = 2; //Paid;



                                        $pStatus = TableRegistry::getTableLocator()->get('payments');
                                        $query = $pStatus->query();
                                        $query->insert(['trxId', 'ref_proxy', 'amount', 'sender', 'receiver', 'pay_date', 'payment_type_id', 'pay_media', 'created', 'status'])
                                            ->values($payment)
                                            ->execute();
                                    }
                                    $admission_roll = sprintf("%03s", $students[0]['level']) . $rollRows[0]['roll'];
                                    $admission_data['id'] = $students[0]['id'];
                                    $admission_data['roll'] = $admission_roll;
                                    $admission_data['payment_id'] = $newPaymentId;
                                    $admission_data['status'] = 2;

                                    $aStatus = TableRegistry::getTableLocator()->get('admissions');
                                    $query = $aStatus->query();
                                    $query->update()
                                        ->set($admission_data)
                                        ->where(['id' => $students[0]['id']])
                                        ->execute();

                                    $rolls['id'] = $rollRows[0]['id'];
                                    $rolls['status'] = 1;

                                    $rStatus = TableRegistry::getTableLocator()->get('admission_rolls');
                                    $query = $rStatus->query();
                                    $query->update('admission_rolls')
                                        ->set($rolls + [$rollFeild => 1, 'status' => 1])
                                        ->where(['id' => $rollRows[0]['id']])
                                        ->execute(); //So, the roll status is booked;




                                    if ($aStatus && $pStatus && $rStatus) {
                                        $students[0]['roll'] = $admission_roll;
                                        $this->set('admitter', $students[0]);
                                    } else {
                                        $dataSource->rollback();
                                        $validationErrors['pErr'] = 'Verification Error! Please contact with administrator OR try again.';
                                    }
                                } else {
                                    $validationErrors['pErr'] = 'Invalid amount [Tk. ' . $response->transaction->amount . '] is paid! It should be Tk.' . $this->pAmount . ' exactly.';
                                }
                            } else {
                                $validationErrors['pErr'] = 'Oops! The trxId number doesn\'t match with the reference number! Please try with another trxId or reference number.';
                            }
                        } else {
                            $validationErrors['pErr'] = $this->get_bKash_statusMSG($response->transaction->trxStatus);
                        }
                    } else {
                        $validationErrors['pErr'] = $this->isAdmissionOpen ? 'Network Error !! Please try again.' : 'Sorry! The Admission system is closed. No new payment is acceptable.';
                    }
                }
            } else {
                $validationErrors = Set::merge($this->Admission->validationErrors, $this->Payment->validationErrors);
            }
        }
    }



    private function generateRefNum($session, $level, $id)
    {
        $session = date("Y");
        $schoolCode = '9';
        if (!$level)
            $level = 0;
        $sessionPart = substr($session, 3); //last digit;

        if ($level !== 90 || $level !== 91 || $level !== 92) {
            $level = sprintf("%02s", $level);
        }
        $REF = $schoolCode . $sessionPart . $level . sprintf("%04s", $id); //mt_rand(10501,90905); //????????????????????????????
        return $REF; //$this->is_Ref_Exist_InDb($REF)? $this->generateRefNum($session,$level) : $REF;
    }



    private function verifyPaymentResponse($trxId, $REF)
    {
        $response = false;
        $getProxy = TableRegistry::getTableLocator()->get('payments');
        $getProxys = $getProxy
            ->find()
            ->where(['trxId' => $trxId])
            ->where(['ref_proxy' != NULL])
            ->where(['status' != 2])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();

        if ($getProxys) {
            $response = array('transaction' => array(
                'amount' => $getProxys[0]['amount'], //5,
                'counter' => 1,
                'currency' => 'BDT',
                'reference' => $getProxys[0]['ref_proxy'], //$REF,
                'receiver' => $getProxys[0]['receiver'], //'01720556561',
                'sender' => $getProxys[0]['sender'], //'01722856004',
                'service' => 'Payment',
                'trxId' => $trxId,
                'trxStatus' => '0000',
                'trxTimestamp' => date('Y-m-d H:i:s'),
                'proxy_id' => $getProxys[0]['id'] //Just to track proxy :)
            ));
        } else if ($this->isAdmissionOpen) { //Admission is closed !!!
            $response = $this->chk_rocket($trxId, array('qType' => 'trxid', 'ref' => $REF));
            $this->scmsDbReconnect();
        }
        return $response;
    }



    private function scmsDbReconnect()
    {
        $db = ConnectionManager::getDataSource('default');
        $db->reconnect();
    }



    private function get_serial($data)
    {
        $student = TableRegistry::getTableLocator()->get('temp_students'); //Execute First
        $students = $student
            ->find()
            ->where(['session' => $data['session']])
            ->where(['level' => $data['level']])
            ->toArray();

        if (!empty($students)) {
            $new_serial = intval(substr($students[0]->sid, -3)) + 1;
            if ($new_serial < 10) {
                $new_serial = '00' . $new_serial;
            } else if ($new_serial < 100) {
                $new_serial = '0' . $new_serial;
            }
        } else {
            $new_serial = '001';
        }
        $session = TableRegistry::getTableLocator()->get('scms_sessions'); //Execute First
        $sessions = $session
            ->find()
            ->where(['session_id' => $data['session']])
            ->toArray();
        $session = intval(substr($sessions[0]->session_name, -2));
        if ($data['level'] < 10) {
            $data['level'] = '0' . $data['level'];
        } else {
            if ($data['level'] = 11) {
                $data['level'] = $data['level'];
            } else {
                $data['level'] = $data['level'];
            }
        }
        $sid = $session . $data['level'] . $new_serial;
        return $sid;
    }



    public function getSectionAjax()
    {
        $this->autoRender = false;
        $Level_id = $_GET['level_id'];
        $shift_id = $_GET['shift_id'];
        $section = TableRegistry::getTableLocator()->get('scms_sections');
        $sections = $section
            ->find()
            ->where(['level_id' => $Level_id])
            ->where(['shift_id' => $shift_id])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        echo json_encode($sections);
    }



    public function getSubjectAjax()
    {
        $this->autoRender = false;
        $Level_id = $_GET['level_id'];
        $group_id = $_GET['group_id'];
        $session_id = $_GET['session_id'];
        $course = TableRegistry::getTableLocator()->get('scms_courses');
        $courses_all = $course
            ->find()
            ->where(['cs.session_id' => $session_id])
            ->where(['cs.level_id' => $Level_id])
            ->where(['course_type_id' => 3]) //static
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->select([
                'level_id' => 'cs.level_id',
            ])
            ->join([
                'cs' => [
                    'table' => 'scms_courses_cycle',
                    'type' => 'LEFT',
                    'conditions' => ['cs.course_id  = scms_courses.course_id'],
                ],
            ])
            ->toArray();
        $courses = array();
        foreach ($courses_all as $course_all) {
            if ($course_all['course_group_id'] == $group_id || $course_all['course_group_id'] == null) {
                $courses[] = $course_all;
            }
        }
        echo json_encode($courses);
    }



    public function getReligionSubjectAjax()
    {
        $this->autoRender = false;
        $Level_id = $_GET['level_id'];
        $session_id = $_GET['session_id'];
        $course = TableRegistry::getTableLocator()->get('scms_courses');
        $courses_all = $course
            ->find()
            ->where(['cs.session_id' => $session_id])
            ->where(['cs.level_id' => $Level_id])
            ->where(['course_type_id' => 5]) //static
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->select([
                'level_id' => 'cs.level_id',
            ])
            ->join([
                'cs' => [
                    'table' => 'scms_courses_cycle',
                    'type' => 'LEFT',
                    'conditions' => ['cs.course_id  = scms_courses.course_id'],
                ],
            ])
            ->toArray();
        echo json_encode($courses_all);
    }



    public function captchaTest()
    {
        $captchaSecret = Configure::read('Service.recaptcha_private_key');
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            if ($request_data['g-recaptcha-response']) {
                $recaptcha = $this->request->getData('g-recaptcha-response');
                $secret = $captchaSecret;
                $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}";
                $response = file_get_contents($url);
                $response_keys = json_decode($response, true);
                if ($response_keys['success']) {
                    $this->Flash->success('Submitted Successfully');
                    return;
                } else {
                    $this->Flash->error('Failed to verify as not a robot.');
                    return;
                }
            } else {
                $this->Flash->error("Please verify that you're not a robot.");
                return;
            }
        }
    }



    ##AJAX FUNCTION FOR USER_LOGIN @SHIHAB
    public function userLoginAjax()
    {
        $this->autoRender = false;
        $username = $_GET['username'];
        $password = $_GET['password'];
        $formattedPassword = date("Y-m-d", strtotime(substr($password, 4, 4) . '-' . substr($password, 2, 2) . '-' . substr($password, 0, 2)));

        $response = [];

        $studentsTable = TableRegistry::getTableLocator()->get('scms_students');
        $student = $studentsTable->find()
            ->where(['sid' => $username, 'date_of_birth' => $formattedPassword])
            ->first();

        if ($student) {
            $this->request->getSession()->write('sid', $username);
            $response['status'] = 'success';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Incorrect username or password';
        }

        echo json_encode($response);
    }



    public function userLogout()
    {
        $this->request->getSession()->destroy();

        // Redirect the user to a Homepage
        return $this->redirect([
            "plugin" => "Croogo/Nodes",
            "controller" => "Nodes",
            "action" => "promoted",
        ]);
    }



    public function getYearlyAttandanceAjax()
    {
        $this->autoRender = false;
        $search_year = $this->request->getQuery('search_year') ?: date('Y');

        $startDate = new DateTime("$search_year-01-01");
        $endDate = new DateTime("$search_year-12-31");

        $allDates = [];

        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $allDates[] = [
                'year' => $currentDate->format('Y'),
                'month' => $currentDate->format('F'),
                'date' => $currentDate->format('d'),
                'status' => '',
            ];
            $currentDate->modify('+1 day');
        }


        // Session Student Cycle ID
        $session_sid = $this->request->getSession()->read('sid');
        $studentCycleTable = TableRegistry::getTableLocator()->get('scms_students');
        $student_session = $studentCycleTable
            ->find()
            ->select([
                'student_cycle_id' => 'student_cycle.student_cycle_id',
            ])
            ->join([
                'student_cycle' => [
                    'table' => 'scms_student_cycle',
                    'type' => 'LEFT',
                    'conditions' => [
                        'student_cycle.student_id = scms_students.student_id'
                    ]
                ]
            ])
            ->where(['sid' => $session_sid])
            ->first();
        $session_scid = $student_session->student_cycle_id;


        $attendanceTable = TableRegistry::getTableLocator()->get('scms_attendance');
        $attendance = $attendanceTable
            ->find()
            ->where(['student_cycle_id' => $session_scid])
            ->order(['date' => 'DESC'])
            ->toArray();

        $dateArray = [];
        foreach ($attendance as $entity) {
            $dateObject = $entity->date;
            $year = $dateObject->format('Y');
            $month = $dateObject->format('F');
            $date = $dateObject->format('d');

            // Add month and date to the array
            $dateArray[] = [
                'year' => $year,
                'month' => $month,
                'date' => $date,
                'status' => 'present',
            ];
        }

        // Combine $allDates and $dateArray into a new array
        $resultArray = [];

        foreach ($allDates as $allDate) {
            $year = $allDate['year'];
            $month = $allDate['month'];
            $date = $allDate['date'];
            $status = '';

            // Check if the date exists in $dateArray
            foreach ($dateArray as $dateItem) {
                if ($dateItem['year'] == $year && $dateItem['month'] == $month && $dateItem['date'] == $date) {
                    $status = $dateItem['status'];
                    break; // Stop searching once a match is found
                }
            }

            // Add the combined data to the result array
            $resultArray[] = [
                'year' => $year,
                'month' => $month,
                'date' => $date,
                'status' => $status,
            ];
        }

        $groupedResults = [];

        foreach ($resultArray as $result) {
            $month = $result['month'];
            if (!isset($groupedResults[$month])) {
                $groupedResults[$month] = [];
            }
            $groupedResults[$month][] = $result;
        }

        $this->response = $this->response->withType('application/json');
        echo json_encode($groupedResults);
    }



    public function sessionStudent()
    {
        $session_sid = $this->request->getSession()->read('sid');
        $studentCycleTable = TableRegistry::getTableLocator()->get('scms_students');
        $student_session = $studentCycleTable
            ->find()
            ->select([
                'student_cycle_id' => 'student_cycle.student_cycle_id',
            ])
            ->join([
                'student_cycle' => [
                    'table' => 'scms_student_cycle',
                    'type' => 'LEFT',
                    'conditions' => [
                        'student_cycle.student_id = scms_students.student_id '
                    ]
                ]
            ])
            ->where(['sid' => $session_sid])
            ->first();
        $session_scid = $student_session['student_cycle_id'];
        return $session_scid;
    }



    public function studentDashboard()
    {
        $this->layout = 'user_dashboard_layout';
        $session_sid = $this->request->getSession()->read('sid');
        if (!$session_sid) {
            // Session does not exist or 'sid' is not set, redirect to the homepage
            return $this->redirect([
                "plugin" => "Croogo/Nodes",
                "controller" => "Nodes",
                "action" => "promoted",
            ]);
        }

        $studentTable = TableRegistry::getTableLocator()->get('scms_students');
        $student_session = $studentTable
            ->find()
            ->where(['sid' => $session_sid])
            ->first();
        $session_student_id = $student_session->student_id;

        $sscid = $this->sessionStudent(); //Student_cycle_id from session.

        if ($this->request->is(['post'])) {
            $request_data = $this->request->getData();

            $student_id = $session_student_id; //##//  Will get session data where the id will be there
            $student_data['name'] = $request_data['name'];
            $student_data['mobile'] = $request_data['mobile'];
            $student_data['email'] = $request_data['email'];
            $student_data['date_of_birth'] = $request_data['date_of_birth'];
            $student_data['birth_registration'] = $request_data['birth_registration'];
            $student_data['gender'] = $request_data['gender'];
            $student_data['religion'] = $request_data['religion'];
            $student_data['permanent_address'] = $request_data['permanent_address'];

            $students = TableRegistry::getTableLocator()->get('scms_students');
            $query = $students->query();
            $query->update()
                ->set($student_data)
                ->where(['student_id' => $student_id])
                ->execute();
        }
        $basic = TableRegistry::getTableLocator()->get('scms_students'); //Execute First
        $basics = $basic
            ->find()
            ->where(['student_id' => $session_student_id]) //##//  Will get session data where the id will be there
            ->toArray();
        $this->set('students', $basics[0]);

        $student_cycle = TableRegistry::getTableLocator()->get('scms_student_cycle');
        $student_cycles = $student_cycle
            ->find()
            ->where(['session_id' => $basics[0]->session_id])
            ->where(['student_id' => $basics[0]->student_id])
            ->toArray();
        $this->set('student_cycle', $student_cycles[0]);

        $level = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $level
            ->find()
            ->where(['level_id' => $student_cycles[0]->level_id])
            ->toArray();
        $this->set('levels', $levels[0]);

        $section = TableRegistry::getTableLocator()->get('scms_sections');
        $sections = $section
            ->find()
            ->where(['shift_id' => $student_cycles[0]->shift_id])
            ->where(['level_id' => $student_cycles[0]->level_id])
            ->toArray();
        $this->set('sections', $sections[0]);

        $session = TableRegistry::getTableLocator()->get('scms_sessions');
        $sessions = $session
            ->find()
            ->where(['session_id' => $basics[0]->session_id])
            ->order(['session_name' => 'DESC'])
            ->toArray();
        $this->set('sessions', $sessions[0]);


        // ByDefault ATTENDANCE Report
        $year = date('Y');
        $startDate = new DateTime("$year-01-01");
        $endDate = new DateTime("$year-12-31");

        $allDates = array();

        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $allDates[] = [
                'year' => $currentDate->format('Y'),
                'month' => $currentDate->format('F'),
                'date' => $currentDate->format('d'),
                'status' => '',
            ];

            $currentDate->modify('+1 day');
        }

        $attendanceTable = TableRegistry::getTableLocator()->get('scms_attendance');
        $attendance = $attendanceTable
            ->find()
            ->where(['student_cycle_id' => $sscid]) //##// STUDENT CYCLE ID FROM SESSION
            ->order(['date' => 'DESC'])
            ->toArray();

        $dateArray = [];

        foreach ($attendance as $entity) {
            $dateObject = $entity->date;

            $year = $dateObject->format('Y');
            $month = $dateObject->format('F');
            $date = $dateObject->format('d');

            // Add month and date to the array
            $dateArray[] = [
                'year' => $year,
                'month' => $month,
                'date' => $date,
                'status' => 'present',

            ];
        }

        // Combine $allDates and $dateArray into a new array
        $resultArray = [];

        foreach ($allDates as $allDate) {
            $year = $allDate['year'];
            $month = $allDate['month'];
            $date = $allDate['date'];
            $status = '';

            // Check if the date exists in $dateArray
            foreach ($dateArray as $dateItem) {
                if ($dateItem['year'] == $year && $dateItem['month'] == $month && $dateItem['date'] == $date) {
                    $status = $dateItem['status'];
                    break; // Stop searching once a match is found
                }
            }

            // Add the combined data to the result array
            $resultArray[] = [
                'year' => $year,
                'month' => $month,
                'date' => $date,
                'status' => $status,
            ];
        }
        $groupedResults = [];
        foreach ($resultArray as $result) {
            $month = $result['month'];
            if (!isset($groupedResults[$month])) {
                $groupedResults[$month] = [];
            }
            $groupedResults[$month][] = $result;
        }
        $this->set('groupedResults', $groupedResults);


        #RESULT LIST FOR STUDENT
        $result_student_table = TableRegistry::getTableLocator()->get('scms_result_students');
        $result_students = $result_student_table
            ->find()
            ->select([
                'term_name' => 'term.term_name',
                'sid' => 'students.sid',
                'level_name' => 'level.level_name',
                'session_name' => 'session.session_name',
            ])
            ->join([
                'stc' => [
                    'table' => 'scms_student_term_cycle',
                    'type' => 'LEFT',
                    'conditions' => [
                        'stc.student_term_cycle_id = scms_result_students.student_term_cycle_id '
                    ]
                ],
                'sc' => [
                    'table' => 'scms_student_cycle',
                    'type' => 'LEFT',
                    'conditions' => [
                        'sc.student_cycle_id = stc.student_cycle_id'
                    ],
                ],
                'students' => [
                    'table' => 'scms_students',
                    'type' => 'LEFT',
                    'conditions' => [
                        'students.student_id = sc.student_id'
                    ],
                ],
                'level' => [
                    'table' => 'scms_levels',
                    'type' => 'LEFT',
                    'conditions' => [
                        'level.level_id = sc.level_id'
                    ],
                ],
                'session' => [
                    'table' => 'scms_sessions',
                    'type' => 'LEFT',
                    'conditions' => [
                        'session.session_id = sc.session_id'
                    ],
                ],
                'tc' => [
                    'table' => 'scms_term_cycle',
                    'type' => 'LEFT',
                    'conditions' => [
                        'tc.term_cycle_id = stc.term_cycle_id'
                    ],
                ],
                'term' => [
                    'table' => 'scms_term',
                    'type' => 'LEFT',
                    'conditions' => [
                        'term.term_id = tc.term_id'
                    ],
                ],

            ])
            ->where(['sid' => $session_sid])  //##// STUDENT SID FROM SESSION
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('result_students', $result_students);



        #ACOUNTS
        $transactionsTable = TableRegistry::getTableLocator()->get('acc_transactions');
        $transactions = $transactionsTable
            ->find()
            ->where(['student_cycle_id' => $sscid]) //##// STUDENT CYCLE ID FROM SESSION
            ->order(['voucher_no' => 'ASC'])
            ->select([
                'bank_name' => 'bank.bank_name'
            ])->join([
                'bank' => [
                    'table' => 'acc_banks',
                    'type' => 'INNER',
                    'conditions' => [
                        'bank.bank_id = acc_transactions.bank_id '
                    ]
                ]
            ])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('transactions', $transactions);
    }



    public function viewResult($id)
    {
        $session_sid = $this->request->getSession()->read('sid');
        $this->layout = 'result';
        $this->autoRender = false;
        $where['scms_students.sid'] = $session_sid; //##// STUDENT SID FROM SESSION
        $where['result_id'] = $id;

        ##ACCESS OTHER CONTRONER FROM OTHER PLUGIN
        $resultsController = new ResultsController();
        $resultData  = $resultsController->studentResultView($id, $where);

        $this->set('students', $resultData['students']);
        $this->set('scms_activity_remarks', $resultData['scms_activity_remarks']);
        $this->set('heads', $resultData['heads']);
        $this->set('position', $resultData['position']);
        $this->set('exam_title', $resultData['exam_title']);
        $this->set('last_row_colspan', $resultData['last_row_colspan']);
        $this->set('decemal_point', $resultData['decemal_point']);
        $this->set('total_attandance', $resultData['total_attandance']);
        $this->render('/Contacts/view_result');
    }




    public function formView()
    {

        ## WILL BE USED LATER IF REQUIRED

    }



    public function twoTakaSearch()
    {
        $this->set('title_for_layout', __('Two Taka Information'));
        $this->layout = 'result';
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();
            $sid = $request_data['sid'];
            $dob = $request_data['dob'];
            $session = $request_data['session_id'];
            if (!empty($sid) && !empty($dob) && !empty($session)) {

                $student = TableRegistry::getTableLocator()->get('scms_student_cycle'); //Execute First
                $students = $student
                    ->find()
                    ->where(['s.sid' => $sid])
                    ->where(['s.date_of_birth' => $dob])
                    ->where(['s.session_id' => $session])
                    ->enableAutoFields(true)
                    ->enableHydration(false)
                    ->select([
                        "name" => "s.name",
                        "voucher" => "a.voucher_no",
                        "date" => "a.transaction_date",
                        "amount" => "a.amount"
                    ])
                    ->join([
                        'a' => [
                            'table' => ' acc_transactions',
                            'type' => 'INNER',
                            'conditions' => [
                                'a.student_cycle_id  = scms_student_cycle.student_cycle_id',
                                'a.note'  => 'Two Taka Fund Collection'
                            ],
                        ],
                    ])
                    ->join([
                        's' => [
                            'table' => ' scms_students',
                            'type' => 'INNER',
                            'conditions' => [' s.student_id  = scms_student_cycle.student_id'],
                        ],
                    ])
                    ->toArray();
                $this->set('students', $students);
            }
        }
        $session = TableRegistry::getTableLocator()->get('scms_sessions');
        $sessions = $session
            ->find()
            ->order(['session_name' => 'DESC'])
            ->toArray();
        $this->set('sessions', $sessions);
    }


    public function sidSearch()
    {
        if ($this->request->is('post')) {
            $request_data = $this->request->getData();

            $where['scms_student_cycle.session_id'] = $request_data['session_id'];
            if ($request_data['shift_id']) {
                $where['scms_student_cycle.shift_id'] = $request_data['shift_id'];
            }
            if ($request_data['level_id']) {
                $where['scms_student_cycle.level_id'] = $request_data['level_id'];
            }
            if ($request_data['section_id']) {
                $where['scms_student_cycle.section_id'] = $request_data['section_id'];
            }
            if ($request_data['roll']) {
                $where['scms_student_cycle.roll'] = $request_data['roll'];
            }
            $scms_student_cycle = TableRegistry::getTableLocator()->get('scms_student_cycle');
            $scms_student_cycles = $scms_student_cycle
                ->find()
                ->where($where)
                ->enableAutoFields(true)
                ->enableHydration(false)
                ->select([
                    'name' => "s.name",
                    'sid' => "s.sid",
                ])
                ->join([
                    's' => [
                        'table' => 'scms_students',
                        'type' => 'INNER',
                        'conditions' => [
                            's.student_id = scms_student_cycle.student_id'
                        ]
                    ],
                ])
                ->toArray();
            $this->set('students', $scms_student_cycles[0]);
            $this->set('session_id', $request_data['session_id']);
            $this->set('shift_id', $request_data['shift_id']);
            $this->set('level_id', $request_data['level_id']);
            $this->set('section_id', $request_data['section_id']);
            $this->set('roll', $request_data['roll']);
        }
        $session = TableRegistry::getTableLocator()->get('scms_sessions');
        $sessions = $session
            ->find()
            ->toArray();
        $this->set('sessions', $sessions);
        $level = TableRegistry::getTableLocator()->get('scms_levels');
        $levels = $level
            ->find()
            ->toArray();
        $this->set('levels', $levels);
        $section = TableRegistry::getTableLocator()->get('scms_sections');
        $sections = $section
            ->find()
            ->toArray();
        $this->set('sections', $sections);
        $shift = TableRegistry::getTableLocator()->get('hr_shift');
        $shifts = $shift
            ->find()
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        $this->set('shifts', $shifts);
    }


    public function getLevelSectionAjax()
    {
        $this->autoRender = false;
        $Level_id = $_GET['level_id'];
        $shift_id = $_GET['shift_id'];
        $section = TableRegistry::getTableLocator()->get('scms_sections');
        $sections = $section
            ->find()
            ->where(['level_id' => $Level_id])
            ->where(['shift_id' => $shift_id])
            ->enableAutoFields(true)
            ->enableHydration(false)
            ->toArray();
        echo json_encode($sections);
    }

}
