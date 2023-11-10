<?php

return [
    'Contact\\Model\\Contact' => [
        'fields' => [
            'id' => [
                'type' => 'INT',
                'attrs' => [
                    'unsigned' => TRUE,
                    'primary_key' => TRUE,
                    'auto_increment' => TRUE
                ],
                'index' => 1000
            ],

            // visitor area
            'ip' => [
                'type' => 'VARCHAR',
                'length' => 50,
                'attrs' => [
                    'null' => true
                ],
                'index' => 2000
            ],
            'post' => [
                'type' => 'INT',
                'attrs' => [
                    'null' => true
                ],
                'index' => 2000
            ],
            'type' => [
                'type' => 'INT',
                'attrs' => [
                    'default' => 1
                ],
                'index' => 2000
            ],
            'fullname' => [
                'type' => 'VARCHAR',
                'length' => 200,
                'attrs' => [
                    'null' => false 
                ],
                'index' => 3000
            ],
            'email' => [
                'type' => 'VARCHAR',
                'length' => 200,
                'attrs' => [
                    'null' => false 
                ],
                'index' => 4000
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'length' => 200,
                'attrs' => [
                    'null' => false 
                ],
                'index' => 5000
            ],
            'amount' => [
                'type' => 'INT',
                'length' => 200,
                'attrs' => [
                    'null' => true,
                    'default' => 0 
                ],
                'index' => 5000
            ],
            'date' => [
                'type' => 'DATE',
                'attrs' => [
                    'null' => false 
                ],
                'index' => 5000
            ],
            'description' => [
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 6000
            ],

            'user' => [
                'type' => 'INT',
                'attrs' => [
                    'null' => true 
                ],
                'index' => 7000
            ],
            'reply' => [
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 8000
            ],

            'seen' => [
                'type' => 'DATETIME',
                'attrs' => [
                    'null' => true
                ],
                'index' => 9000
            ],
            'replyed' => [
                'type' => 'DATETIME',
                'attrs' => [
                    'null' => true
                ],
                'index' => 10000
            ],
            'updated' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP',
                    'update' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 11000
            ],
            'created' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 12000
            ]
        ],
        'indexes' => [
            'by_ip' => [
                'fields' => [
                    'ip' => []
                ]
            ]
        ]
    ],
    'SiteSetting\\Model\\SiteSetting' => [
        'data' => [
            'name' => [
                'contact_admin_email' => [
                    'name' => 'contact_admin_email',
                    'type' => 7,
                    'group' => 'Contact',
                    'value' => 'admin@localhost'
                ]
            ]
        ]
    ]
];
