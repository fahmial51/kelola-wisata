<?php

return [
    'name' => 'Kelola Wisata',
    'version' => '0.0.1',
    'host' => 'admin-wisata.test',
    'timezone' => 'Asia/Jakarta',
    'install' => '2023-10-31 10:08:03',
    'secure' => FALSE,
    '__gitignore' => [
        'modules/*' => NULL,
        '!modules/.gitkeep' => NULL
    ],
    'libModel' => [
        'connections' => [
            'default' => [
                'driver' => 'mysql',
                'configs' => [
                    'main' => [
                        'host' => 'localhost',
                        'user' => 'devteam',
                        'dbname' => 'wisata',
                        'passwd' => '8473'
                    ]
                ]
            ]
        ]
    ],
    'libUpload' => [
        'base' => [
            'local' => 'media',
            'host' => 'http://admin-wisata.test/media/'
        ]
    ],
    'libCurl' => [
        'log' => TRUE
    ]
];