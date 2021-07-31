<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Countries configuration
    |--------------------------------------------------------------------------
    |
    | This option controls the default countries, code and regext that is used on phone numbers
    | validation by your application. Countries should be retrieved
    | and used from a persistent storage; however, this is the current static list.
    |
    */

    'countries' => [
        ['name' => 'Cameroon', 'code' => 237, 'regex' => "\(237\)\ ?[2368]\d{7,8}$"],
        ['name' => 'Ethiopia', 'code' => 251, 'regex' => "\(251\)\ ?[1-59]\d{8}"],
        ['name' => 'Morocco', 'code' => 212, 'regex' => "\(212\)\ ?[5-9]\d{8}$"],
        ['name' => 'Mozambique', 'code' => 258, 'regex' => "\(258\)\ ?[28]\d{7,8}$"],
        ['name' => 'Uganda', 'code' => 256, 'regex' => "\(256\)\ ?\d{9}$"],
    ],
];
