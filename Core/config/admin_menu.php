<?php

namespace Croogo\Core\Config;

use Croogo\Core\Nav;

Nav::add('sidebar', 'Gallery', [
    'icon' => 'camera',
    'title' => __d('gallery', 'Gallery'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Album',
        'action' => 'viewAlbum',
    ],
    'weight' => 70,
    'children' => [
        'ListofAlbums' => [// students is a example but there must be different name for different menu
            'title' => __d('gallery', 'List of Albums'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Album',
                'action' => 'viewAlbum',
            ],
            'weight' => 10,
        ],
        'List of Photos' => [
            'title' => __d('gallery', 'List of Photos'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Photos',
                'action' => 'viewPhotos',
            ],
            'weight' => 100,
        ],
        'Tution Fees' => [
            'title' => __d('menu', 'Tution Fees'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'tutionFees',
            ],
            'weight' => 110,
        ],
        'Promotion List' => [
            'title' => __d('menu', 'Promotion List'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'promotionList',
            ],
            'weight' => 115,
        ],
        'Student\'s data Settings' => [
            'title' => __d('menu', 'Student\'s Fields'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'dataSettings',
            ],
            'weight' => 120,
        ],
        'Student\'s data Count' => [
            'title' => __d('menu', 'Student\'s Block Add'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'dataCount',
            ],
            'weight' => 130,
        ],
        'Student\'s datas' => [
            'title' => __d('menu', 'Student\'s All Blocks'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'datas',
            ],
            'weight' => 140,
        ],
    ],
]);

Nav::add('sidebar', 'CMS', [
    'icon' => 'desktop',
    'title' => __d('boxes', 'CMS'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Cms',
        'action' => 'boxes',
    ],
    'weight' => 80,
    'children' => [
        'ListofBoxes' => [
            'title' => __d('boxes', 'List of Boxes'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Cms',
                'action' => 'Boxes',
            ],
            'weight' => 10,
        ],
        'ListofConfigs' => [
            'title' => __d('boxes', 'List of Configs'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Cms',
                'action' => 'pageConfig',
            ],
            'weight' => 101,
        ],
        'QuickLink' => [
            'title' => __d('boxes', 'Quick Links'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Cms',
                'action' => 'quickLink',
            ],
            'weight' => 111,
        ],
    ],
]);

Nav::add('sidebar', 'Setup', [
    'icon' => 'cogs',
    'title' => __d('Setup', 'Setup'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Setup',
        'action' => 'index',
    ],
    'weight' => 90,
    'children' => [
        'Facuties' => [
            'title' => __d('Setup', 'Facuties'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
                'action' => 'faculty',
            ],
            'weight' => 10,
        ],
        'Department' => [
            'title' => __d('Setup', 'Department'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
                'action' => 'department',
            ],
            'weight' => 20,
        ],
        'Classes' => [
            'title' => __d('Setup', 'Classes'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
                'action' => 'level',
            ],
            'weight' => 30,
        ],
        'Sections' => [
            'title' => __d('Setup', 'Sections'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
                'action' => 'section',
            ],
            'weight' => 40,
        ],
        'Sessions' => [
            'title' => __d('Setup', 'Sessions'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
                'action' => 'session',
            ],
            'weight' => 50,
        ],
        'Shifts' => [
            'title' => __d('Setup', 'Shifts'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
                'action' => 'shift',
            ],
            'weight' => 60,
        ],
        'Courses & Terms' => [
            'title' => __d('menu', 'Courses & Terms'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
                'action' => 'index',
            ],
            'weight' => 80,
            'children' => [
                'Course' => [
                    'title' => __d('menu', 'Course'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'course',
                    ],
                    'weight' => 10,
                    'children' => [
                        'Course' => [
                            'title' => __d('menu', 'Course'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Setup',
                                'action' => 'course',
                            ],
                            'weight' => 10,
                        ],
                        'Courses Cycle' => [
                            'title' => __d('menu', 'Courses Cycle'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Setup',
                                'action' => 'coursesCycle',
                            ],
                            'weight' => 20,
                        ],
                    ],
                ],
                'Activity' => [
                    'title' => __d('menu', 'Activity'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'activity',
                    ],
                    'weight' => 20,
                    'children' => [
                        'Activity' => [
                            'title' => __d('menu', 'Activity'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Setup',
                                'action' => 'activity',
                            ],
                            'weight' => 30,
                        ],
                        'Activity Cycle' => [
                            'title' => __d('menu', 'Activity Cycle'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Setup',
                                'action' => 'activityCycle',
                            ],
                            'weight' => 40,
                        ],
                    ],
                ],
                'Terms' => [
                    'title' => __d('menu', 'Terms'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'term',
                    ],
                    'weight' => 20,
                    'children' => [
                        'Terms' => [
                            'title' => __d('menu', 'Terms'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Setup',
                                'action' => 'term',
                            ],
                            'weight' => 50,
                        ],
                        'Term Cycle' => [
                            'title' => __d('menu', 'Term Cycle'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Setup',
                                'action' => 'termCycle',
                            ],
                            'weight' => 60,
                        ],
                    ],
                ],
                'Part Distribution' => [
                    'title' => __d('menu', 'Part Distribution'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'marksDistribution',
                    ],
                    'weight' => 70,
                ],
                'Term Courses List' => [
                    'title' => __d('menu', 'Term Courses List'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'termCoursesList',
                    ],
                    'weight' => 80,
                ],
            ],
        ],
        'Promotion' => [
            'title' => __d('menu', 'Promotion'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Setup',
            ],
            'weight' => 90,
            'children' => [
                'Course Cycle' => [
                    'title' => __d('menu', 'Course Cycle'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'courseCyclePromotion',
                    ],
                    'weight' => 10,
                ],
                'Activity Cycle' => [
                    'title' => __d('menu', 'Activity Cycle'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'activityCyclePromotion',
                    ],
                    'weight' => 20,
                ],
                'Term Cycle' => [
                    'title' => __d('menu', 'Term Cycle'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Setup',
                        'action' => 'termCyclePromotion',
                    ],
                    'weight' => 30,
                ],
            ],
        ],
        'Gradings' => [
            'title' => __d('menu', 'Gradings'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Gradings',
                'action' => 'index',
            ],
            'weight' => 100,
        ],
    ],
]);

Nav::add('sidebar', 'SMS Panel', [
    'icon' => 'envelope',
    'title' => __d('menu', 'SMS Panel'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Sms',
        'action' => 'index',
    ],
    'weight' => 100,
    'children' => [
        'General SMS' => [
            'title' => __d('menu', 'General SMS'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Sms',
                'action' => 'index',
            ],
            'weight' => 10,
        ],
        'SMS Logs' => [
            'title' => __d('menu', 'SMS Logs'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Sms',
                'action' => 'smsLogs',
            ],
            'weight' => 20,
        ],
        'SMS Permission' => [
            'title' => __d('menu', 'SMS Permission'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'sms',
                'action' => 'smsPermission',
            ],
            'weight' => 30,
        ],
    ],
]);

Nav::add('sidebar', 'Students', [
    'icon' => 'address-book',
    'title' => __d('menu', 'Students'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Students',
        'action' => 'index',
    ],
    'weight' => 110,
    'children' => [
        'students' => [// students is a example but there must be different name for different menu
            'title' => __d('menu', 'Students'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'index',
            ],
            'weight' => 10,
        ],
        'add' => [
            'title' => __d('menu', 'Add a Student'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'add',
            ],
            'weight' => 20,
        ],
        'Add Mark' => [
            'title' => __d('menu', 'Add Mark'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'addResult',
            ],
            'weight' => 40,
        ],
        'Add Quiz Mark' => [
            'title' => __d('menu', 'Add Quiz Mark'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'addQuizResult',
            ],
            'weight' => 50,
        ],
        'Add Activity' => [
            'title' => __d('menu', 'Add Activity'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'addActivityResult',
            ],
            'weight' => 50,
        ],
        'Promotion' => [
            'title' => __d('menu', 'Promotion'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'promotion',
            ],
            'weight' => 60,
            'children' => [
                'Promotion' => [
                    'title' => __d('menu', 'Promotion'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Students',
                        'action' => 'promotion',
                    ],
                    'weight' => 10,
                ],
                'Promotion Template' => [
                    'title' => __d('menu', 'Promotion Template'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Students',
                        'action' => 'promotionTemplate',
                    ],
                    'weight' => 20,
                ],
                'Promotion Log' => [
                    'title' => __d('menu', 'Promotion Log'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Students',
                        'action' => 'promotionLog',
                    ],
                    'weight' => 30,
                ],
            ],
        ],
        'Temp Student\'s List' => [
            'title' => __d('menu', 'Temp Student\'s List'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'tindex',
            ],
            'weight' => 70,
        ],
        'Admission Room' => [
            'title' => __d('menu', 'Admission Room'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'admissionRoom',
            ],
            'weight' => 80,
        ],
        'Seat Plan' => [
            'title' => __d('menu', 'Admission Seat Plan'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'seatplan',
            ],
            'weight' => 90,
        ],
        'View Seat Plan' => [
            'title' => __d('menu', 'Admission View Seat Plan'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'viewSeatplan',
            ],
            'weight' => 100,
        ],
        'Tution Fees' => [
            'title' => __d('menu', 'Tution Fees'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'tutionFees',
            ],
            'weight' => 110,
        ],
        'Promotion List' => [
            'title' => __d('menu', 'Promotion List'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'promotionList',
            ],
            'weight' => 115,
        ],
        'Student\'s data Settings' => [
            'title' => __d('menu', 'Student\'s Fields'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'dataSettings',
            ],
            'weight' => 120,
        ],
        'Student\'s data Count' => [
            'title' => __d('menu', 'Student\'s Block Add'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'dataCount',
            ],
            'weight' => 130,
        ],
        'Student\'s datas' => [
            'title' => __d('menu', 'Student\'s All Blocks'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'datas',
            ],
            'weight' => 140,
        ],
    ],
]);

Nav::add('sidebar', 'Attendance', [
    'icon' => 'calendar-check',
    'title' => __d('menu', 'Attendance'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Attendance',
        'action' => 'index',
    ],
    'weight' => 120,
    'children' => [
        'Attendance' => [
            'title' => __d('menu', 'Attendance'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Attendance',
                'action' => 'index',
            ],
            'weight' => 10,
        ],
        'Device Attendence' => [
            'title' => __d('menu', 'Device Attendence'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Attendance',
                'action' => 'deviceAttendence',
            ],
            'weight' => 20,
        ],
        'Device Log' => [
            'title' => __d('menu', 'Device Log'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Attendance',
                'action' => 'deviceLog',
            ],
            'weight' => 30,
        ]
    ],
]);

Nav::add('sidebar', 'Result', [
    'icon' => 'list-ol',
    'title' => __d('menu', 'Result'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Results',
        'action' => 'index',
    ],
    'weight' => 130,
    'children' => [
        'Result' => [
            'title' => __d('menu', 'Result'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Results',
                'action' => 'index',
            ],
            'weight' => 10,
        ],
        'View Result' => [
            'title' => __d('menu', 'View Result'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Results',
                'action' => 'viewResult',
            ],
            'weight' => 20,
        ],
        'Merge Result' => [
            'title' => __d('menu', 'Merge Result'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Results',
                'action' => 'mergeResult',
            ],
            'weight' => 30,
        ],
        'View Merge Result' => [
            'title' => __d('menu', 'View Merge Result'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Results',
                'action' => 'viewMergeResult',
            ],
            'weight' => 40,
        ],
        'Result Template' => [
            'title' => __d('menu', 'Result Template'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Results',
                'action' => 'indexTemplate',
            ],
            'weight' => 50,
        ],
        'Number Fordo' => [
            'title' => __d('menu', 'Number Fordo'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'numberFordo',
            ],
            'weight' => 60,
        ],
    ],
]);

Nav::add('sidebar', 'Accounts', [
    'icon' => 'university',
    'title' => __d('menu', 'Accounts'),
    'weight' => 140,
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Accounts',
        'action' => 'index',
    ],
    'children' => [
        'Bank' => [
            'title' => __d('menu', 'Bank'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
                'action' => 'Banks',
            ],
            'weight' => 10,
        ],
        'Purposes' => [
            'title' => __d('menu', 'Purposes'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
                'action' => 'purposes',
            ],
            'weight' => 20,
        ],
        'Transactions' => [
            'title' => __d('menu', 'Transactions'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
            ],
            'weight' => 30,
            'children' => [
                'Debit' => [
                    'title' => __d('menu', 'Debit'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                    ],
                    'weight' => 10,
                    'children' => [
                        'addDebit' => [
                            'title' => __d('menu', 'Add Debit'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Accounts',
                                'action' => 'addDebit',
                            ],
                            'weight' => 10,
                        ],
                        'List of Debit' => [
                            'title' => __d('menu', 'List of Debit'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Accounts',
                                'action' => 'debitList',
                            ],
                            'weight' => 20,
                        ],
                    ],
                ],
                'Credit' => [
                    'title' => __d('menu', 'Credit'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                    ],
                    'weight' => 20,
                    'children' => [
                        'addCredit' => [
                            'title' => __d('menu', 'Add Credit'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Accounts',
                                'action' => 'addCredit',
                            ],
                            'weight' => 10,
                        ],
                        'List of Credit' => [
                            'title' => __d('menu', 'List of Credit'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Accounts',
                                'action' => 'creditList',
                            ],
                            'weight' => 20,
                        ],
                        'Unpaid Vouchers' => [
                            'title' => __d('menu', 'Unpaid Vouchers'),
                            'url' => [
                                'prefix' => 'admin',
                                'plugin' => 'Croogo/Core',
                                'controller' => 'Accounts',
                                'action' => 'unpaidVouchers',
                            ],
                            'weight' => 30,
                        ],
                    ],
                ],
            ],
        ],
        'Additional Fees' => [
            'title' => __d('menu', 'Additionals'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
                'action' => 'additionalFees',
            ],
            'weight' => 30,
            'children' => [
                'additionalFees' => [
                    'title' => __d('menu', 'Additional Fees'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'additionalFees',
                    ],
                    'weight' => 20,
                ],
                'generateAdditionalFees' => [
                    'title' => __d('menu', 'Generate Fees'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'generateAdditionalFees',
                    ],
                    'weight' => 30,
                ],
                'Individual Fees' => [
                    'title' => __d('menu', 'Individual Fees'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'individualFees',
                    ],
                    'weight' => 40,
                ],
            ],
        ],
        'FeesKhats' => [
            'title' => __d('menu', 'Fees-Khats'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
            ],
            'weight' => 31,
            'children' => [
                'FeesKhatSettings' => [
                    'title' => __d('menu', 'Fees-Khat Settings'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'feesKhatSettings',
                    ],
                    'weight' => 10,
                ],
                'multipleFeesKhat' => [
                    'title' => __d('menu', 'Multiple Fees-Khat Settings'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'multipleFeesKhat',
                    ],
                    'weight' => 20,
                ],
                'voucher Generate' => [
                    'title' => __d('menu', 'Voucher Generate'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'voucherGenerate',
                    ],
                    'weight' => 30,
                ],
                'Indivisul Voucher' => [
                    'title' => __d('menu', 'Indivisul Voucher'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'indivisulVoucher',
                    ],
                    'weight' => 40,
                ],
            ],
        ],
        'School Fees' => [
            'title' => __d('menu', 'School Fees'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
                'action' => 'schoolFees',
            ],
            'weight' => 50,
        ],
        'Report' => [
            'title' => __d('menu', 'Accounts Report'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
                'action' => 'index',
            ],
            'weight' => 60,
            'children' => [
                'Transaction Report' => [
                    'title' => __d('menu', 'Transaction Statement'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'transactionStatement',
                    ],
                    'weight' => 10,
                ],
                'Payment Details' => [
                    'title' => __d('menu', 'Payment Details'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'paymentDetails',
                    ],
                    'weight' => 20,
                ],
                'Balance Report' => [
                    'title' => __d('menu', 'Balance Report'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'balanceReport',
                    ],
                    'weight' => 30,
                ],
                'Voucher Statement' => [
                    'title' => __d('menu', 'Voucher Statement'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'voucherStatement',
                    ],
                    'weight' => 40,
                ],
                'Due Report' => [
                    'title' => __d('menu', 'Due Report'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'dueReport',
                    ],
                    'weight' => 50,
                ],
            ],
        ],
        'Deleted' => [
            'title' => __d('menu', 'Deleted'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts'
            ],
            'weight' => 70,
            'children' => [
                'Deleted Banks' => [
                    'title' => __d('menu', 'Deleted Banks'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'deletedBanks',
                    ],
                    'weight' => 10,
                ],
                'Deleted Purposes' => [
                    'title' => __d('menu', 'Deleted Purposes'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'deletedPurposes',
                    ],
                    'weight' => 20,
                ],
                'Deleted Transactions' => [
                    'title' => __d('menu', 'Deleted Transactions'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Accounts',
                        'action' => 'deletedTransactions',
                    ],
                    'weight' => 30,
                ],
            ],
        ],
        'Two Taka Fund' => [
            'title' => __d('menu', 'Two Taka Fund'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Accounts',
                'action' => 'twoTakafund',
            ],
            'weight' => 60,
        ],
    ],
]);

Nav::add('sidebar', 'Core HR', [
    'icon' => 'database',
    'title' => __d('menu', 'Core HR'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Hrs',
        'action' => 'index',
    ],
    'weight' => 150,
    'children' => [
        'Shift' => [
            'title' => __d('menu', 'Shift'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'shifts',
            ],
            'weight' => 10,
        ],
        'Roster' => [
            'title' => __d('menu', 'Roster'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'roster',
            ],
            'weight' => 15,
        ],
        'Hr Config' => [
            'title' => __d('menu', 'Hr Config'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'config',
            ],
            'weight' => 20,
        ],
        'Hr Config Setup' => [
            'title' => __d('menu', 'Hr Config Setup'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'configSetup',
            ],
            'weight' => 30,
        ],
        'Employee Attendance' => [
            'title' => __d('menu', 'Employee Attendance'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'attendance',
            ],
            'weight' => 40,
        ],
        'CSV Attendance' => [
            'title' => __d('menu', 'CSV Attendance'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'csvAttendance',
            ],
            'weight' => 45,
        ],
        'Attendance Report' => [
            'title' => __d('menu', 'Attendance Report'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
            ],
            'weight' => 46,
            'children' => [
                'Monthly Report' => [
                    'title' => __d('menu', 'Monthly Report'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Hrs',
                        'action' => 'monthlyAttendanceReport',
                    ],
                    'weight' => 10,
                ],
            ],
        ],
        'Calendar' => [
            'title' => __d('menu', 'Calendar'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'calendar',
            ],
            'weight' => 50,
        ],
        'all_leave' => [
            'title' => __d('menu', 'All Leaves'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'allLeaves',
            ],
            'weight' => 60,
        ],
        'Payroll' => [
            'title' => __d('menu', 'Payroll'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Hrs',
                'action' => 'payroll',
            ],
            'weight' => 70,
        ],
    ],
]);

Nav::add('sidebar', 'Admit Card', [
    'icon' => 'address-card',
    'title' => __d('admit', 'Admit Card'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Admit',
        'action' => 'index',
    ],
    'weight' => 160,
    'children' => [
        'Admit Cards' => [
            'title' => __d('admit', 'List of Admit Cards'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Admit',
                'action' => 'index',
            ],
            'weight' => 10,
        ],
        'Bench Slip' => [
            'title' => __d('admit', 'Bench Slip'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Admit',
                'action' => 'slip',
            ],
            'weight' => 100,
        ],
    ],
]);

Nav::add('sidebar', 'Admissions', [
    'icon' => 'bookmark',
    'title' => __d('menu', 'Admissions'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Students',
        'action' => 'tindex',
    ],
    'weight' => 170,
    'children' => [
        'Admissions List' => [
            'title' => __d('menu', 'Admissions'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'tindex',
            ],
            'weight' => 20,
        ],
        'Payment List' => [
            'title' => __d('menu', 'Payment List'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Students',
                'action' => 'paymentList',
            ],
            'weight' => 20,
        ],
    ],
]);

Nav::add('sidebar', 'Employee', [
    'icon' => 'users',
    'title' => __d('menu', 'Employee'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Employees',
    ],
    'weight' => 180,
    'children' => [
        'Profile' => [
            'title' => __d('menu', 'Profile'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Employees',
            ],
            'weight' => 10,
            'children' => [
                'viewProfile' => [
                    'title' => __d('menu', 'View Profile'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Employees',
                        'action' => 'profile',
                    ],
                    'weight' => 20,
                ],
                'leave' => [
                    'title' => __d('menu', 'Leave'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Employees',
                        'action' => 'leave',
                    ],
                    'weight' => 30,
                ],
                'Calender' => [
                    'title' => __d('menu', 'Calender'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Employees',
                        'action' => 'Calender',
                    ],
                    'weight' => 40,
                ],
            ],
        ],
        'AllEmployee' => [
            'title' => __d('menu', 'All Employee'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Employees',
                'action' => 'index',
            ],
            'weight' => 20,
        ],
        'Designation' => [
            'title' => __d('menu', 'Designation'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Employees',
                'action' => 'designation',
            ],
            'weight' => 30,
        ],
        'inactiveEmployees' => [
            'title' => __d('menu', 'Inactive Employees'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Employees',
                'action' => 'inactiveEmployees',
            ],
            'weight' => 40,
        ], 'exEmployees' => [
            'title' => __d('menu', 'EX-Employees'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Employees',
                'action' => 'exEmployees',
            ],
            'weight' => 50,
        ],
    ],
]);

Nav::add('sidebar', 'Teachers', [
    'icon' => 'id-badge',
    'title' => __d('menu', 'Teachers'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Teachers',
        'action' => 'index',
    ],
    'weight' => 190,
    'children' => [
        'Teachers' => [
            'title' => __d('menu', 'Teachers'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Teachers',
                'action' => 'index',
            ],
            'weight' => 20,
        ],
        'Assign Teachers' => [
            'title' => __d('menu', 'Assign Teachers'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Teachers',
                'action' => 'assignTeacher',
            ],
            'weight' => 10,
        ],
        'Designations' => [
            'title' => __d('menu', 'Designations'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Teachers',
                'action' => 'designation',
            ],
            'weight' => 30,
        ],
    ],
]);

Nav::add('sidebar', 'Staffs', [
    'icon' => 'users',
    'title' => __d('menu', 'Staffs'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Staffs',
        'action' => 'index',
    ],
    'weight' => 200,
]);

Nav::add('sidebar', 'Certificates', [
    'icon' => 'certificate',
    'title' => __d('menu', 'Certificates'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Certificates',
        'action' => 'index',
    ],
    'weight' => 210,
    'children' => [
        'Configuration' => [
            'title' => __d('menu', 'Configuration'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Certificates',
                'action' => 'index',
            ],
            'weight' => 10,
            'children' => [
                'Certificate Type' => [
                    'title' => __d('menu', 'Certificate Type'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Certificates',
                        'action' => 'allTypes',
                    ],
                    'weight' => 10,
                ],
                'Tags' => [
                    'title' => __d('menu', 'Tags'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Certificates',
                        'action' => 'allTags',
                    ],
                    'weight' => 20,
                ],
                'Configuration' => [
                    'title' => __d('menu', 'All Configuration'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Certificates',
                        'action' => 'configCirtificates',
                    ],
                    'weight' => 30,
                ],
            ],
        ],
        'Certificates' => [
            'title' => __d('menu', 'Certificates'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Certificates',
                'action' => 'index',
            ],
            'weight' => 20, 'children' => [
                'Certificate Type' => [
                    'title' => __d('menu', 'Add Certificate'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Certificates',
                        'action' => 'addCertificates',
                    ],
                    'weight' => 10,
                ],
                'View Certificates' => [
                    'title' => __d('menu', 'View Certificates'),
                    'url' => [
                        'prefix' => 'admin',
                        'plugin' => 'Croogo/Core',
                        'controller' => 'Certificates',
                        'action' => 'viewCertificates',
                    ],
                    'weight' => 20,
                ],
            ],
        ],
    ],
]);

Nav::add('sidebar', 'Library Section', [
    'icon' => 'book',
    'title' => __d('menu', 'Library Section'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Library',
        'action' => 'index',
    ],
    'weight' => 220,
    'children' => [
        'Books' => [
            'title' => __d('menu', 'Books'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Library',
                'action' => 'books',
            ],
            'weight' => 10,
        ],
        'allIssues' => [
            'title' => __d('menu', 'Issued Books'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Library',
                'action' => 'allIssues',
            ],
            'weight' => 20,
        ],
        'Return Books' => [
            'title' => __d('menu', 'Return Books'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Library',
                'action' => 'returnBooks',
            ],
            'weight' => 30,
        ],
        'Members' => [
            'title' => __d('menu', 'Members'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Library',
                'action' => 'members',
            ],
            'weight' => 40,
        ],
    ],
]);

//Nav Menu Gallery by @shihab
Nav::add('sidebar', 'Gallery', [
    'icon' => 'camera',
    'title' => __d('gallery', 'Gallery'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Album',
        'action' => 'viewAlbum',
    ],
    'weight' => 55,
    'children' => [
        'ListofAlbums' => [// students is a example but there must be different name for different menu
            'title' => __d('gallery', 'List of Albums'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Album',
                'action' => 'viewAlbum',
            ],
            'weight' => 10,
        ],
        'List of Photos' => [
            'title' => __d('gallery', 'List of Photos'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Photos',
                'action' => 'viewPhotos',
            ],
            'weight' => 100,
        ],
    ],
]);

Nav::add('sidebar', 'CMS', [
    'icon' => 'desktop',
    'title' => __d('boxes', 'CMS'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Cms',
        'action' => 'boxes',
    ],
    'weight' => 56,
    'children' => [
        'ListofBoxes' => [
            'title' => __d('boxes', 'List of Boxes'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Cms',
                'action' => 'Boxes',
            ],
            'weight' => 10,
        ],
        'ListofConfigs' => [
            'title' => __d('boxes', 'List of Configs'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Cms',
                'action' => 'pageConfig',
            ],
            'weight' => 101,
        ],
        'QuickLink' => [
            'title' => __d('boxes', 'Quick Links'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Cms',
                'action' => 'quickLink',
            ],
            'weight' => 111,
        ],
    ],
]);

//Nav Menu Admit Card by @shovon
Nav::add('sidebar', 'Admit Card', [
    'icon' => 'address-card',
    'title' => __d('admit', 'Admit Card'),
    'url' => [
        'prefix' => 'admin',
        'plugin' => 'Croogo/Core',
        'controller' => 'Admit',
        'action' => 'index',
    ],
    'weight' => 55,
    'children' => [
        'Admit Cards' => [
            'title' => __d('admit', 'List of Admit Cards'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Admit',
                'action' => 'index',
            ],
            'weight' => 10,
        ],
        'Bench Slip' => [
            'title' => __d('admit', 'Bench Slip'),
            'url' => [
                'prefix' => 'admin',
                'plugin' => 'Croogo/Core',
                'controller' => 'Admit',
                'action' => 'slip',
            ],
            'weight' => 100,
        ],
    ],
]);
