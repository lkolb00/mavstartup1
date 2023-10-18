<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Version
    |--------------------------------------------------------------------------
    |
    | This value is the version of your application. This value is used when the
    | framework needs to place the application's version in a notification of
    | any other location as required by the application or its packages.
    */

    'version' => env('APP_VERSION', '1.0.0'),

    /*
    |--------------------------------------------------------------------------
    | Application API Version
    |--------------------------------------------------------------------------
    |
    | This value is the api version of your application. This value is used when the
    | framework needs to place the application's api version in a notification of
    | any other location as required by the application or its packages.
    */

    'api_version' => env('API_VERSION', '1.0'),

    /*
    |--------------------------------------------------------------------------
    | Application Socialite Login Feature
    |--------------------------------------------------------------------------
    |
    | This value determines if authentication with OAuth providers using laravel
    | socialite is supported by your application. This will enable socialite
    | buttons in your application Login and Register screens. This will
    | allow the user. The provider can be one of [facebook, linkedin,
    | github, twitter, google, gitLab, bitbucket, and slack]. We
    | We have currently tested for providers [github, google].
    | Set this in your ".env" file.
    |
    */

    'login_socialite' => (bool) env('APP_LOGIN_SOCIALITE', true),

];
