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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google'=>[
        "client_id"=>"1044311296554-at6jrggjlbu9t0nioqtsu3vqs45hh7m0.apps.googleusercontent.com",
        "client_secret"=>"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",
        "redirect"=>"http://localhost:8000/auth/google/callback",
    ],
    'facebook'=>[
        "client_id"=>"295008736694118",
        "client_secret"=>"dd6870e42552ad4bc60c25d9a6951263",
        "redirect"=>"http://localhost:8000/auth/facebook/callback",
    ]

];
