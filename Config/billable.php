<?php

return [
    'providers' => [
        "mercadopago" => [
            "isDevMode" => true,
            "name" => "MercadoPago",
            "tax" => [
                "type" => "percent",
                "amount" => 6.0
            ],
            "currencies" => ["PEN"],
            "token" => env('BILLABLE_MERCADOPAGO_ACCESS_TOKEN')
        ],
        "paypal" => [
            "isDevMode" => true,
            "name" => "Paypal",
            "tax" => [
                "type" => "percent",
                "amount" => 6.0
            ],
            "currencies" => ["USD"],
            "token" => [
                "CLIENT_ID" => env('BILLABLE_PAYPAL_CLIENT_ID'),
                "CLIENT_SECRET" => env('BILLABLE_PAYPAL_CLIENT_SECRET')
            ]
        ]
    ],
    'table' => [
        "prefix" => "cri_",
        "users" => "users"
    ],

    'order' => [
        'user' => [
            /***
             *
             * How the user relation will show it
             * can be as an object [key name] => "Column name"
             *  'columns' => [
             *      "id" => 'id',
             *      "name" => "name",
             *      "lastname" => "lastname"
             *  ]
             * or just as an array
             * ["id", "name", "lastname", "email"] -> this will use each column as a key name
             *
             * **/
            'columns' => [
                "id" => 'id',
                "name" => "name",
                "lastname" => "lastname",
                "email" => "email"
            ]
        ]
    ]
];
