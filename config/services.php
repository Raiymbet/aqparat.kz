<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
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

    // Socialite Providers
    'github' => [
        'client_id' => '33c8cbab9def00c1a1f2',
        'client_secret' => '8a4615b33e5d56156396e2bb22835897d51b2b47',
        'redirect' => 'http://localhost:8080/aqparat.kz/public/socialite/callback/github',
    ],
    'google' => [
        'client_id' => '487210922676-tgbpp9i45dlf5ps06getp2taj1jf4kl5.apps.googleusercontent.com',
        'client_secret' => 'hEh64HWo1GmCplBEIHZ1VsiC',
        'redirect' => 'http://localhost:8080/aqparat.kz/public/socialite/callback/google',
    ],
    'facebook' => [
        'client_id' => '866679340130202',
        'client_secret' => '4491a9231e157822f18c8438c3e220b5',
        'redirect' => 'http://localhost:8080/aqparat.kz/public/socialite/callback/facebook',
    ],
    'twitter' => [
        'client_id' => 'UCf9uMLZuxvslY5giPzFhS8vf',
        'client_secret' => 'DZ3gxVWtVsOA2tLBY2ZZb9HqM9xz8My4jkgI6ByJNgxzKKx9b1',
        'redirect' => 'http://localhost:8080/aqparat.kz/public/socialite/callback/twitter',
    ],
    'vkontakte' => [
        'client_id' => '5661749',
        'client_secret' => 'ntD228BZpbxiUFvXsMZv',
        'redirect' => 'http://localhost:8080/aqparat.kz/public/socialite/callback/vkontakte',
    ],
];
