<?php

return [
    '__name' => 'contact',
    '__version' => '0.0.5',
    '__git' => 'git@github.com:getmim/contact.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/contact' => ['install','update','remove'],
        'theme/mailer/contact' => ['install','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-model' => NULL
            ],
            [
                'lib-formatter' => NULL
            ],
            [
                'lib-user' => NULL
            ],
            [
                'lib-mailer' => NULL
            ],
            [
                'site-setting' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'Contact\\Model' => [
                'type' => 'file',
                'base' => 'modules/contact/model'
            ],
            'Contact\\Library' => [
                'type' => 'file',
                'base' => 'modules/contact/library'
            ]
        ],
        'files' => []
    ],
    'libEnum' => [
        'enums' => [
            'contact.type' => [1=>'Activity', 2=>'Product']
        ]
    ],
    'libFormatter' => [
        'formats' => [
            'contact' => [
                'id' => [
                    'type' => 'number'
                ],
                'ip' => [
                    'type' => 'text'
                ],
                'post' => [
                    'type' => 'object-switch',
                    'field' => 'type',
                    'cases' => [
                        1 => [
                            'model' => [
                                'name'  => 'Post\\Model\\Post',
                                'field' => 'id',
                                'type'  => 'number'
                            ],
                            'format' => 'post'
                        ],
                        2 => [
                            'model' => [
                                'name'  => 'Product\\Model\\Product',
                                'field' => 'id',
                                'type'  => 'number'
                            ],
                            'format' => 'product'
                        ],
                    ],
                    
                ],
                'type' => [
                    'type' => 'enum',
                    'enum' => 'contact.type',
                    'vtype' => 'int'
                ],
                'fullname' => [
                    'type' => 'text'
                ],
                'email' => [
                    'type' => 'text'
                ],
                'phone' => [
                    'type' => 'text'
                ],
                'amount' => [
                    'type' => 'text'
                ],
                'date' => [
                    'type' => 'date'
                ],
                'description' => [
                    'type' => 'text'
                ],
                'user' => [
                    'type' => 'object',
                    'model' => [
                        'name' => 'LibUser\\Library\\Fetcher',
                        'field' => 'id',
                        'type' => 'number'
                    ],
                    'format' => 'user'
                ],
                'reply' => [
                    'type' => 'text'
                ],
                'evidence' => [
                    'type' => 'text'
                ],
                'seen' => [
                    'type' => 'date'
                ],
                'replyed' => [
                    'type' => 'date',
                    'timezone' => 'UTC'
                ],
                'updated' => [
                    'type' => 'date',
                    'timezone' => 'UTC'
                ],
                'created' => [
                    'type' => 'date',
                    'timezone' => 'UTC'
                ]
            ]
        ]
    ],
    // 'adminSetting' => [
    //     'menus' => [
    //         'site-contact' => [
    //             'label' => 'Contact',
    //             'icon' => '<i class="fas fa-file-signature"></i>',
    //             'info' => 'Change site contact preference',
    //             'perm' => 'update_site_setting',
    //             'index' => 0,
    //             'options' => [
    //                 'site-contact' => [
    //                     'label' => 'Change settings',
    //                     'route' => ['adminSiteSettingSingle',['group' => 'Contact']]
    //                 ]
    //             ]
    //         ]
    //     ]
    // ]
];
