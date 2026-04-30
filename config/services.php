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

    'izipay' => [
        'username' => env('IZIPAY_USERNAME'),
        'password_test' => env('IZIPAY_PASSWORD_TEST'),
        'password_prod' => env('IZIPAY_PASSWORD_PROD'),
        'key_public_test' => env('KEY_PUBLIC_TEST'),
        'key_public_prod' => env('KEY_PUBLIC_PROD'),
        'clave_hmac_sha_test' => env('CLAVE_HMAC_SHA_TEST'),
        'clave_hmac_sha_prod' => env('CLAVE_HMAC_SHA_PROD'),
        'url' => env('IZIPAY_API'),
        
    ],

];
