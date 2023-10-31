<?php

return [
    '__name' => 'post-category-logo',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/post-category-logo.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/post-category-logo' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-model' => NULL
            ],
            [
                'post-category' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [],
        'files' => []
    ],
    'libFormatter' => [
        'formats' => [
            'post-category' => [
                'logo' => [
                    'type' => 'media'
                ]
            ]
        ]
    ]
];
