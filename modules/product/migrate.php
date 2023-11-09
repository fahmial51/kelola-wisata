<?php

return [
    'Product\\Model\\Product' => [
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
            'user' => [
                'type' => 'INT',
                'attrs' => [
                    'unsigned' => TRUE,
                    'null' => FALSE
                ],
                'index' => 2000
            ],
            'name' => [
                'type' => 'VARCHAR',
                'length' => 150,
                'attrs' => [
                    'null' => FALSE
                ],
                'index' => 3000
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'length' => 150,
                'attrs' => [
                    'null' => FALSE,
                    'unique' => TRUE
                ],
                'index' => 4000
            ],
            'cover' => [
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 5000
            ],
            'gallery' => [
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 6000
            ],
            'price' => [
                'comment' => '{one},{min,max},{daily,weekly,monthly,anually}',
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 7000
            ],
            'price_min' => [
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => TRUE,
                    'null' => FALSE
                ],
                'index' => 8000
            ],
            'price_max' => [
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => TRUE,
                    'null' => FALSE
                ],
                'index' => 9000
            ],
            'content' => [
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 10000
            ],
            'status' => [
                'comment' => '0 Deleted, 1 Draft, 2 Published',
                'type' => 'TINYINT',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false,
                    'default' => 1
                ],
                'index' => 11000
            ],
            'meta' => [
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 12000
            ],
            'updated' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP',
                    'update' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 13000
            ],
            'created' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 14000
            ]
        ]
    ]
];