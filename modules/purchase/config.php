<?php

return [
    '__name' => 'purchase',
    '__version' => '0.2.0',
    '__git' => 'git@github.com:getmim/purchase.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/purchase' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-model' => NULL
            ],
            [
                'lib-enum' => NULL
            ],
            [
                'lib-formatter' => NULL
            ],
            [
                'product' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'Purchase\\Model' => [
                'type' => 'file',
                'base' => 'modules/purchase/model'
            ],
            'Purchase\\Library' => [
                'type' => 'file',
                'base' => 'modules/purchase/library'
            ]
        ],
        'files' => []
    ],
    'libEnum' => [
        'enums' => [
            'purchase.status' => [
                0  => 'Canceled',
                10 => 'Draft',
                20 => 'Expired',
                30 => 'Checkout',
                40 => 'Paid',
                50 => 'Approved',
                60 => 'Delivering',
                70 => 'Delivered',
                80 => 'Returning',
                90 => 'Returned'
            ]
        ]
    ],
    'libFormatter' => [
        'formats' => [
            'purchase' => [
                'id' => [
                    'type' => 'number'
                ],
                'user' => [
                    'type' => 'user'
                ],
                'invoice' => [
                    'type' => 'text'
                ],
                'status' => [
                    'type' => 'enum',
                    'enum' => 'purchase.status',
                    'vtype' => 'int'
                ],
                'items' => [
                    'type' => 'number'
                ],
                'quantity' => [
                    'type' => 'number'
                ],
                'price' => [
                    'type' => 'number',
                    'decimal' => 2
                ],
                'total' => [
                    'type' => 'number',
                    'decimal' => 2
                ],
                'reason' => [
                    'type' => 'text'
                ],
                'updated' => [
                    'type' => 'date'
                ],
                'created' => [
                    'type' => 'date'
                ]
            ],
            'purchase-product' => [
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
                'product' => [
                    'type' => 'object',
                    'model' => [
                        'name' => 'Product\\Model\\Product',
                        'field' => 'id',
                        'type' => 'number'
                    ],
                    'format' => 'product'
                ],
                'quantity' => [
                    'type' => 'number'
                ],
                'price' => [
                    'type' => 'number',
                    'decimal' => 2
                ],
                'total' => [
                    'type' => 'number',
                    'decimal' => 2
                ],
                'updated' => [
                    'type' => 'date'
                ],
                'created' => [
                    'type' => 'date'
                ]
            ]
        ]
    ],
    'purchase' => [
        'invoice' => [
            'generator' => 'Purchase\\Library\\Invoice',
            'prefix' => 'INV-',
            'length' => 8
        ]
    ]
];
