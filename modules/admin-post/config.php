<?php

return [
    '__name' => 'admin-post',
    '__version' => '0.2.0',
    '__git' => 'git@github.com:getmim/admin-post.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/admin-post' => ['install','update','remove'],
        'theme/admin/post' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'admin' => NULL
            ],
            [
                'post' => NULL
            ],
            [
                'lib-formatter' => NULL
            ],
            [
                'lib-form' => NULL
            ],
            [
                'lib-pagination' => NULL
            ],
            [
                'lib-upload' => NULL
            ],
            [
                'admin-site-meta' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'AdminPost\\Controller' => [
                'type' => 'file',
                'base' => 'modules/admin-post/controller'
            ],
            'AdminPost\\Library' => [
                'type' => 'file',
                'base' => 'modules/admin-post/library'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'admin' => [
            'adminPost' => [
                'path' => [
                    'value' => '/post/(:type)',
                    'params' => [
                        'type' => 'slug'
                    ]
                ],
                'method' => 'GET',
                'handler' => 'AdminPost\\Controller\\Post::index'
            ],
            'adminPostEdit' => [
                'path' => [
                    'value' => '/post/(:type)/(:id)',
                    'params' => [
                        'type' => 'slug',
                        'id' => 'number'
                    ]
                ],
                'method' => 'GET|POST',
                'handler' => 'AdminPost\\Controller\\Post::edit'
            ],
            'adminPostRemove' => [
                'path' => [
                    'value' => '/post/(:id)/remove',
                    'params' => [
                        'id' => 'number'
                    ]
                ],
                'method' => 'GET',
                'handler' => 'AdminPost\\Controller\\Post::remove'
            ]
        ]
    ],
    'adminUi' => [
        'sidebarMenu' => [
            'items' => [
                'post' => [
                    'label' => 'Publication',
                    'icon' => '<i class="fas fa-newspaper"></i>',
                    'priority' => 0,
                    'children' => [
                        'all-destination' => [
                            'label' => 'All Destination',
                            'icon'  => '<i></i>',
                            'route' => ['adminPost', ['type' =>'destination']],
                            'perms' => 'manage_post'
                        ],
                        'all-article' => [
                            'label' => 'All Article & Event',
                            'icon'  => '<i></i>',
                            'route' => ['adminPost', ['type' =>'article']],
                            'perms' => 'manage_post'
                        ],
                        'all-hotel' => [
                            'label' => 'All Hotel',
                            'icon'  => '<i></i>',
                            'route' => ['adminPost', ['type' => 'hotel']],
                            'perms' => 'manage_post'
                        ],
                        'all-tour-guide' => [
                            'label' => 'All Activity',
                            'icon'  => '<i></i>',
                            'route' => ['adminPost', ['type' => 'activity']],
                            'perms' => 'manage_post'
                        ]
                    ]
                ]
            ]
        ]
    ],
    'libForm' => [
        'forms' => [
            'admin.post.edit' => [
                '@extends' => ['std-site-meta','std-cover', 'std-info'],
                'title' => [
                    'label' => 'Title',
                    'type' => 'text',
                    'rules' => [
                        'required' => TRUE
                    ]
                ],
                'slug' => [
                    'label' => 'Slug',
                    'type' => 'text',
                    'slugof' => 'title',
                    'rules' => [
                        'required' => TRUE,
                        'empty' => FALSE,
                        'unique' => [
                            'model' => 'Post\\Model\\Post',
                            'field' => 'slug',
                            'self' => [
                                'service' => 'req.param.id',
                                'field' => 'id'
                            ]
                        ]
                    ]
                ],
                'status' => [
                    'label' => 'Status',
                    'type' => 'select',
                    'rules' => [
                        'required' => true 
                    ]
                ],
                'type' => [
                    'label' => 'Type',
                    'type' => 'text',
                    'rules' => [
                        'required' => true 
                    ]
                ],
                'embed' => [
                    'label' => 'Embed',
                    'type' => 'textarea',
                    'rules' => []
                ],
                'featured' => [
                    'label' => 'Featured',
                    'type' => 'checkbox',
                    'rules' => [],
                    'filters' => [
                        'boolean' => true 
                    ]
                ],
                'editor_pick' => [
                    'label' => 'Editor Pick',
                    'type' => 'checkbox',
                    'rules' => [],
                    'filters' => [
                        'boolean' => true 
                    ]
                ],
                'content' => [
                    'label' => 'About',
                    'type' => 'summernote',
                    'upload' => 'std-image',
                    'rules' => [
                        'required' => true
                    ]
                ],
                'meta-schema' => [
                    'options' => [
                        'Article'       => 'Article',
                        'BlogPosting'   => 'BlogPosting',
                        'CreativeWork'  => 'CreativeWork',
                        'NewsArticle'   => 'NewsArticle',
                        'Report'        => 'Report',
                        'Review'        => 'Review',
                        'TechArticle'   => 'TechArticle'
                    ]
                ]
            ],
            'std-info' => [
                'info-name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'rules' => []
                ],
                'info-address' => [
                    'label' => 'Address',
                    'type' => 'textarea',
                    'rules' => []
                ],
                'info-buy_at' => [
                    'label' => 'Buy at',
                    'type' => 'text',
                    'rules' => []
                ],
                'info-price' => [
                    'label' => 'Price Start From',
                    'type' => 'number',
                    'rules' => []
                ],
                'info-url' => [
                    'label' => 'URL',
                    'type' => 'url',
                    'rules' => []
                ],
                'info-gmaps' => [
                    'label' => 'Tour Google Maps Link',
                    'type' => 'url',
                    'rules' => []
                ],
                'info-phone' => [
                    'label' => 'Whatsapp Number',
                    'type' => 'tel',
                    'rules' => []
                ],
                'info-instagram' => [
                    'label' => 'Tour Instagram Link',
                    'type' => 'url',
                    'rules' => []
                ],
            ],
            'admin.post.index' => [
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
                        '1' => 'Draft',
                        '2' => 'Editor',
                        '3' => 'Published'
                    ],
                    'rules' => []
                ]
            ]
        ]
    ],
    'admin' => [
        'objectFilter' => [
            'handlers' => [
                'post' => 'AdminPost\\Library\\Filter'
            ]
        ]
    ]
];
