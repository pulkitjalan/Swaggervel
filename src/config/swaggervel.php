<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Enable swaggervel api and doc routes. Useful for disabling in some envs
      |--------------------------------------------------------------------------
    */
    'enabled' => env('SWAGGERVEL_ENABLED', true),

    /*
      |--------------------------------------------------------------------------
      | Absolute path to location where parsed swagger annotations will be stored
      |--------------------------------------------------------------------------
    */
    'doc-dir' => storage_path().'/docs',

    /*
      |--------------------------------------------------------------------------
      | Relative path to access parsed swagger annotations.
      |--------------------------------------------------------------------------
    */
    'doc-route' => 'docs',

    /*
      |--------------------------------------------------------------------------
      | Absolute path to directory containing the swagger annotations are stored.
      |--------------------------------------------------------------------------
    */
    'app-dir' => 'app',

    /*
      |--------------------------------------------------------------------------
      | Absolute path to directories that you would like to exclude from swagger generation
      |--------------------------------------------------------------------------
    */
    'excludes' => [
        //
    ],

    /*
      |--------------------------------------------------------------------------
      | Turn this off to remove swagger generation on production
      |--------------------------------------------------------------------------
    */
    'generateAlways' => env('SWAGGERVEL_GENERATE_ALWAYS', false),

    /*
      |--------------------------------------------------------------------------
      | Set the api key
      |--------------------------------------------------------------------------
    */
    'api-key' => env('SWAGGERVEL_API_KEY'),

    /*
      |--------------------------------------------------------------------------
      | Edit to set the api's version number
      |--------------------------------------------------------------------------
    */
    'default-api-version' => env('SWAGGERVEL_DEFAULT_API_VERSION', 'v1'),

    /*
      |--------------------------------------------------------------------------
      | Edit to set the swagger version number
      |--------------------------------------------------------------------------
    */
    'default-swagger-version' => env('SWAGGERVEL_DEFAULT_SWAGGER_VERSION', '2.0'),

    /*
      |--------------------------------------------------------------------------
      | Edit to set the api's base path
      |--------------------------------------------------------------------------
    */
    'default-base-path' => env('SWAGGERVEL_DEFAULT_BASE_PATH', '/'),

    /*
      |--------------------------------------------------------------------------
      | Edit to trust the proxy's ip address - needed for AWS Load Balancer
      |--------------------------------------------------------------------------
    */
    'behind-reverse-proxy' => env('SWAGGERVEL_BEHIND_PROXY', false),

    /*
      |--------------------------------------------------------------------------
      | Uncomment to add response headers when swagger is generated
      |--------------------------------------------------------------------------
    */
    // 'viewHeaders' => [
    //     'Content-Type' => 'text/plain',
    // ],

    /*
      |--------------------------------------------------------------------------
      | Uncomment to add request headers when swagger performs requests
      |--------------------------------------------------------------------------
    */
    // 'requestHeaders' => [
    //     'TestMe' => 'testValue',
    // ],
];
