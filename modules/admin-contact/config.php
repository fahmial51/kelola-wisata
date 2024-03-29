<?php

return [
    '__name' => 'admin-contact',
    '__version' => '0.0.3',
    '__git' => 'git@github.com:getmim/admin-contact.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/admin-contact' => ['install','update','remove'],
        'theme/admin/contact' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'admin' => NULL
            ],
            [
                'contact' => NULL
            ],
            [
                'lib-formatter' => NULL
            ],
            [
                'lib-form' => NULL
            ],
            [
                'lib-pagination' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'AdminContact\\Controller' => [
                'type' => 'file',
                'base' => 'modules/admin-contact/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'admin' => [
            'adminContact' => [
                'path' => [
                    'value' => '/reservation'
                ],
                'method' => 'GET',
                'handler' => 'AdminContact\\Controller\\Contact::index'
            ],
            'adminContactReply' => [
                'path' => [
                    'value' => '/reservation/(:id)',
                    'params' => [
                        'id'  => 'number'
                    ]
                ],
                'method' => 'GET|POST',
                'handler' => 'AdminContact\\Controller\\Contact::reply'
            ],
            'adminOrder' => [
                'path' => [
                    'value' => '/order'
                ],
                'method' => 'GET',
                'handler' => 'AdminContact\\Controller\\Contact::order'
            ],
            'adminOrderDelivery' => [
                'path' => [
                    'value' => '/order/(:id)',
                    'params' => [
                        'id'  => 'number'
                    ]
                ],
                'method' => 'GET|POST',
                'handler' => 'AdminContact\\Controller\\Contact::delivery'
            ],
            'adminContactRemove' => [
                'path' => [
                    'value' => '/reservation/(:id)/remove',
                    'params' => [
                        'id'  => 'number'
                    ]
                ],
                'method' => 'GET',
                'handler' => 'AdminContact\\Controller\\Contact::remove'
            ]
        ]
    ],
    'adminUi' => [
        'sidebarMenu' => [
            'items' => [
                'contact' => [
                    'label' => 'Activity Reservation',
                    'icon' => '<i class="fas fa-file-signature"></i>',
                    'priority' => 0,
                    'route' => ['adminContact'],
                    'perms' => 'manage_contact'
                ],
                'order' => [
                    'label' => 'Product Order',
                    'icon' => '<i class="fas fa-file-signature"></i>',
                    'priority' => 0,
                    'route' => ['adminOrder'],
                    'perms' => 'manage_contact'
                ]
            ]
        ]
    ],
    'contact' => [
        'replyRoute' => 'adminContactReply'
    ],
    'libForm' => [
        'forms' => [
            'admin-contact.index' => [
                'q' => [
                    'label' => 'Search',
                    'type' => 'search',
                    'nolabel' => TRUE,
                    'rules' => []
                ],
                'status' => [
                    'label' => 'Status',
                    'type' => 'select',
                    'nolabel' => TRUE,
                    'options' => [
                        '0' => 'All',
                        '1' => 'Unread',
                        '2' => 'Done',
                    ],
                    'rules' => []
                ]
            ],
            'admin-contact.reply' => [
                'reply' => [
                    'label' => 'Note',
                    'type' => 'textarea',
                    'rules' => [
                        'required' => true 
                    ]
                ],
                'evidence' => [
                    'label' => 'Evidence',
                    'type' => 'image',
                    'rules' => [
                        'required' => true 
                    ]
                ]
            ]
        ]
    ]
];
