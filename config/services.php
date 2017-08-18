<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'facebook' => [
    'client_id' => '1824237587859260',
    'client_secret' => 'b5b95829f35845165830be25684f7cc8',
    'redirect' => env('APP_URL').'/callback/facebook',
],
      'google' => [
    'client_id' => '1066661490279-d2nijp2kp9pvr9r4eao7regel9hdslku.apps.googleusercontent.com',
    'client_secret' => 'PwRsb1iPyTLi8XimFINIJ-6H',
    'redirect' => env('APP_URL').'/callback/google',
],
      'twitter' => [
    'client_id' => 'e5yFp8SMCk4B3yiak8ps8AsK7',
    'client_secret' => 'wlKRtfcSdAFk4CcUQao26uXhTOf7hVIY133fqjnmXRvlGnNhcw',
    'redirect' => env('APP_URL').'/callback/twitter',
],
    
    

];
