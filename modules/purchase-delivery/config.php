<?php

return [
    '__name' => 'purchase-delivery',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/purchase-delivery.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/purchase-delivery' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'purchase' => NULL
            ],
            [
                'lib-courier' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'PurchaseDelivery\\Model' => [
                'type' => 'file',
                'base' => 'modules/purchase-delivery/model'
            ]
        ],
        'files' => []
    ],
    'libFormatter' => [
        'formats' => [
            'purchase' => [
                'courier' => [
                    'type' => 'json'
                ],
                'courier_fee' => [
                    'type' => 'number',
                    'decimal' => 2
                ],
                'courier_receipt' => [
                    'type' => 'text'
                ],
                'destination' => [
                    'type' => 'json'
                ]
            ],
            'purchase-delivery' => [
                'id' => [
                    'type' => 'number'
                ],
                'purchase' => [
                    'type' => 'object',
                    'model' => [
                        'name' => 'Purchase\\Model\\Purchase',
                        'field' => 'id',
                        'type' => 'number'
                    ],
                    'format' => 'purchase'
                ],
                'data' => [
                    'type' => 'json'
                ],
                'updated' => [
                    'type' => 'date'
                ],
                'created' => [
                    'type' => 'date'
                ]
            ]
        ]
    ]
];
