<?php

return [
    '__name' => 'cli-app-model',
    '__version' => '0.1.0',
    '__git' => 'git@github.com:getmim/cli-app-model.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/cli-app-model' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'cli-app' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'CliAppModel\\Library' => [
                'type' => 'file',
                'base' => 'modules/cli-app-model/library'
            ],
            'CliAppModel\\Controller' => [
                'type' => 'file',
                'base' => 'modules/cli-app-model/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'tool-app' => [
            'toolAppMigrateDb' => [
                'info' => 'Try to create non exists database',
                'path' => [
                    'value' => 'migrate db'
                ],
                'handler' => 'CliAppModel\\Controller\\Migrate::db'
            ],
            'toolAppMigrateSchema' => [
                'info' => 'Test application database migrate and create sync sql',
                'path' => [
                    'value' => 'migrate schema (:dirname)',
                    'params' => [
                        'dirname' => 'any'
                    ]
                ],
                'handler' => 'CliAppModel\\Controller\\Migrate::schema'
            ],
            'toolAppMigrateStart' => [
                'info' => 'Start application database migrate',
                'path' => [
                    'value' => 'migrate start'
                ],
                'handler' => 'CliAppModel\\Controller\\Migrate::start'
            ],
            'toolAppMigrateTest' => [
                'info' => 'Test application database migrate',
                'path' => [
                    'value' => 'migrate test'
                ],
                'handler' => 'CliAppModel\\Controller\\Migrate::test'
            ]
        ]
    ],
    'cli' => [
        'autocomplete' => [
            '!^app migrate( .*)?$!' => [
                'priority' => 6,
                'handler' => [
                    'class' => 'CliAppModel\\Library\\Autocomplete',
                    'method' => 'command'
                ]
            ],
            '!^app migrate schema( .*)?$!' => [
                'priority' => 7,
                'handler' => [
                    'class' => 'Cli\\Library\\Autocomplete',
                    'method' => 'files'
                ]
            ]
        ]
    ]
];
