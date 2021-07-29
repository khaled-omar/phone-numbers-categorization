<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
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
