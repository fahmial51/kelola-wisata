<?php

return [
    'Cart\\Model\\Cart' => [
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
                    'unsigned' => TRUE
                ],
                'index' => 2000
            ],
            'identifier' => [
                'type' => 'VARCHAR',
                'length' => 100,
                'attrs' => [
                    'unique' => true
                ],
                'index' => 2500
            ],
            'items' => [
                'comment' => 'item count',
                'type' => 'SMALLINT',
                'attrs' => [
                    'unsigned' => TRUE,
                    'null' => FALSE,
                    'default' => 0
                ],
                'index' => 3000
            ],
            'quantity' => [
                'comment' => 'items quantity sum',
                'type' => 'SMALLINT',
                'attrs' => [
                    'unsigned' => TRUE,
                    'null' => FALSE,
                    'default' => 0
                ],
                'index' => 4000
            ],
            'price' => [
                'comment' => 'total price',
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false,
                    'default' => 0
                ],
                'index' => 5000
            ],
            'total' => [
                'comment' => 'final price to pay',
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false,
                    'default' => 0
                ],
                'index' => 6000
            ],
            'status' => [
                'comment' => '0 canceled, 1 active, 2 paid',
                'type' => 'TINYINT',
                'attrs' => [
                    'unsigned' => TRUE,
                    'null' => FALSE,
                    'default' => 1
                ],
                'index' => 7000
            ],
            'updated' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP',
                    'update' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 10000
            ],
            'created' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 11000
            ]
        ]
    ],
    'Cart\\Model\\CartItem' => [
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
            'cart' => [
                'type' => 'INT',
                'attrs' => [
                    'unsigned' => TRUE,
                    'null' => FALSE
                ],
                'index' => 2000
            ],
            'product' => [
                'type' => 'INT',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false,
                ],
                'index' => 3000
            ],
            'quantity' => [
                'type' => 'SMALLINT',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 4000
            ],
            'price' => [
                'comment' => 'single product price',
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 5000
            ],
            'total' => [
                'comment' => 'final price to pay',
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 6000
            ],
            'updated' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP',
                    'update' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 10000
            ],
            'created' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 11000
            ]
        ]
    ]
];
