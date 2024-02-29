<?php

return [
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
             * ["id", "name", "lastname"] -> this will use each column as a key name
             *
             * **/
            'columns' => [
                "id" => 'id',
                "name" => "name",
                "lastname" => "lastname"
            ]
        ]
    ]
];
