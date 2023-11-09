<?php

return [
    'Purchase\\Model\\Purchase' => [
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
            'invoice' => [
                'type' => 'VARCHAR',
                'length' => 100,
                'attrs' => [
                    'unique' => true
                ],
                'index' => 3000
            ],
            'status' => [
                'type' => 'TINYINT',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false,
                    'default' => 10
                ],
                'index' => 4000
            ],
            'items' => [
                'comment' => 'Total product item',
                'type' => 'SMALLINT',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 5000
            ],
            'quantity' => [
                'comment' => 'Total product quantity',
                'type' => 'SMALLINT',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 6000
            ],
            'price' => [
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 10000
            ],
            'total' => [
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 12000
            ],
            'reason' => [
                'type' => 'VARCHAR',
                'length' => 100,
                'attrs' => [],
                'index' => 13000
            ],
            'expires' => [
                'type' => 'DATETIME',
                'attrs' => [
                    'null' => true
                ],
                'index' => 14000
            ],
            'updated' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP',
                    'update' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 15000
            ],
            'created' => [
                'type' => 'TIMESTAMP',
                'attrs' => [
                    'default' => 'CURRENT_TIMESTAMP'
                ],
                'index' => 16000
            ]
        ]
    ],
    'Purchase\\Model\\PurchaseProduct' => [
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
            'purchase' => [
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
                    'null' => false
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
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true,
                    'null' => false
                ],
                'index' => 5000
            ],
            'total' => [
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
