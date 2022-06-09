<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    //my local
    // 'firebase' => [
    //     'api_key' => 'AIzaSyApca1P4dtlX5NNF6Vbal8weyyueifrjj4',
    //     'auth_domain' => 'saitarun-c7cb8.firebaseapp.com',
    //     'database_url' => 'https://saitarun-c7cb8-default-rtdb.firebaseio.com',
    //     'secret' => 'db secret taken from firebase',
    //     'storage_bucket' => 'saitarun-c7cb8.appspot.com"',
    // ]
//chilipi
    'firebase' => [
        'api_key' => 'AIzaSyAAB7ISizZB5voAW1Tr5DQi1RXH2r_7jqI',
        'auth_domain' => 'chilipi-development.firebaseapp.com',
        'database_url' => 'https://chilipi-development-default-rtdb.firebaseio.com/',
        'secret' => 'db secret taken from firebase',
        'storage_bucket' => 'chilipi-development.appspot.com"',
    ]
];
