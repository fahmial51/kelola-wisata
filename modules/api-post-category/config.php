<?php

return [
    '__name' => 'api-post-category',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api-post-category.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api-post-category' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-app' => NULL
            ],
            [
                'api' => NULL
            ],
            [
                'post-category' => NULL
            ],
            [
                'post' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'ApiPostCategory\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api-post-category/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'api' => [
            'apiPostCategoryIndex' => [
                'path' => [
                    'value' => '/post/category'
                ],
                'handler' => 'ApiPostCategory\\Controller\\Category::index',
                'method' => 'GET'
            ],
            'apiPostCategorySingle' => [
                'path' => [
                    'value' => '/post/category/(:identity)',
                    'params' => [
                        'identity' => 'any'
                    ]
                ],
                'handler' => 'ApiPostCategory\\Controller\\Category::single',
                'method' => 'GET'
            ],
            'apiPostCategorySinglePosts' => [
                'path' => [
                    'value' => '/post/category/(:identity)/post',
                    'params' => [
                        'identity' => 'any'
                    ]
                ],
                'handler' => 'ApiPostCategory\\Controller\\Category::post',
                'method' => 'GET'
            ]
        ]
    ]
];