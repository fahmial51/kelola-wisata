<?php

return [
    'Purchase\\Model\\Purchase' => [
        'fields' => [
            'courier' => [
                'comment' => '{provider, package, info}',
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 7000
            ],
            'courier_receipt' => [
                'comment' => 'Courier RESI number',
                'type' => 'VARCHAR',
                'length' => 150,
                'attrs' => [
                    'unique' => true
                ],
                'index' => 8000
            ],
            'destination' => [
                'comment' => '{province, city, district, subdistrict, street, zipcode, recipient, phone}',
                'type' => 'TEXT',
                'attrs' => [],
                'index' => 9000
            ],
            'courier_fee' => [
                'type' => 'DOUBLE',
                'length' => '13,2',
                'attrs' => [
                    'unsigned' => true
                ],
                'index' => 11000
            ]
        ]
    ],
    'PurchaseDelivery\\Model\\PurchaseDelivery' => [
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
            'data' => [
                'type' => 'TEXT',
                'attrs' => [
                    'null' => false
                ],
                'index' => 3000
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
