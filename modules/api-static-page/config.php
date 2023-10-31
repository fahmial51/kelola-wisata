<?php

return [
    '__name' => 'api-static-page',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api-static-page.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api-static-page' => ['install','update','remove']
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
                'static-page' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'ApiStaticPage\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api-static-page/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'api' => [
            'apiStaticPageIndex' => [
                'path' => [
                    'value' => '/page'
                ],
                'handler' => 'ApiStaticPage\\Controller\\Page::index',
                'method' => 'GET'
            ],
            'apiStaticPageSingle' => [
                'path' => [
                    'value' => '/page/(:identity)',
                    'params' => [
                        'identity' => 'any'
                    ]
                ],
                'handler' => 'ApiStaticPage\\Controller\\Page::single',
                'method' => 'GET'
            ]
        ]
    ]
];