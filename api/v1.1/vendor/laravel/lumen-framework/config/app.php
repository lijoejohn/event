<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'client_base_url' => 'http://'.$_SERVER['HTTP_HOST'].'/event',

    'api_base_url' => 'http://'.$_SERVER['HTTP_HOST'].'/event/api/v1.1',

    'client_id' => 'B8B2DFF6189270D5EA14B6513A10718D78B82494D05C4D3118CBAADEAA2A33E5',

    'client_secret' => '13FFF7C032AA2ECB5BD6460641C12E9315AFD16F36F0200BC42ECD5D53721E68',

    'key' => env('APP_KEY', 'SomeRandomString!!!'),

    'cipher' => 'AES-256-CBC',
    'speed_limit' => 50,

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Mail\MailServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
    ],
    'aliases' => [

        'Image' => Intervention\Image\Facades\Image::class
    ]

];
