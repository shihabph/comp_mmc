    <?php
    $css = [
        'teacher' // an external CSS file
    ];
    echo $this->Html->css($css); // Assigning CSS in the webroot>css folder.
    $js = [
        // an external JS file
    ];
    echo $this->Html->script($js); // Assigning JS in the webroot>js folder.
    echo $this->Blocks->get('css');
    echo $this->Blocks->get('script');
    ?>
    <h4 class="content_title">
        <?php if ($employees!=null) {
            echo $employees[0]->role_title;
        } else {
            echo "No Roles Found";
        } ?>
    </h4><!-- Title should be dynamic here -->
    <div class="row mt-3 grid_emp">
        <?php foreach ($employees as $employee) { ?>
            <div class="col-md-4 teachers col-6 mb-4 ">
                <a href="<?php echo $this->Url->build(['controller' => 'Contacts', 'action' => 'employeesProfile', $employee['employee_id']]); ?>">
                    <?php echo $this->Html->image('/webroot/uploads/employee_images/regularSize/' . $employee['image_name'], ['alt' => $employee['employee_name'], 'class' => 'custom_img']); ?>
                    <span class="name_deg  pt-2 pb-4 px-2">
                        <?= $employee['employee_name'] ?><br>
                        <?= $employee['designation_title'] ?>
                    </span>
                </a>
            </div>
        <?php } ?>
    </div>
