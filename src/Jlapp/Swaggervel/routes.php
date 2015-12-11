<?php

Route::any(Config::get('swaggervel.doc-route').'/{page?}', function ($page = 'api-docs.json') {
    $filePath = Config::get('swaggervel.doc-dir').'/'.$page;

    if (File::extension($filePath) === '') {
        $filePath .= '.json';
    }
    if (! File::Exists($filePath)) {
        App::abort(404, 'Cannot find '.$filePath);
    }

    $content = File::get($filePath);

    return Response::make($content, 200, [
        'Content-Type' => 'application/json',
    ]);
});

Route::get('api-docs', function () {
    if (Config::get('swaggervel.generateAlways')) {
        $appDir = base_path().'/'.Config::get('swaggervel.app-dir');
        $docDir = Config::get('swaggervel.doc-dir');

        if (! File::exists($docDir) || File::isWritable($docDir)) {
            // delete existing documentation
            $filename = $docDir.'/api-docs.json';
            File::delete($filename);

            $defaultBasePath = Config::get('swaggervel.default-base-path');
            $defaultApiVersion = Config::get('swaggervel.default-api-version');
            $defaultSwaggerVersion = Config::get('swaggervel.default-swagger-version');
            $excludeDirs = Config::get('swaggervel.excludes');

            $swagger = \Swagger\scan($appDir, [
                'exclude' => $excludeDirs,
            ]);

            File::put($filename, $swagger);
        }
    }

    if (Config::get('swaggervel.behind-reverse-proxy')) {
        $proxy = Request::server('REMOTE_ADDR');
        Request::setTrustedProxies([$proxy]);
    }

    Blade::setEscapedContentTags('{{{', '}}}');
    Blade::setContentTags('{{', '}}');

    //need the / at the end to avoid CORS errors on Homestead systems.
    $response = response()->view('swaggervel::index', [
        'secure' => Request::secure(),
        'urlToDocs' => url(Config::get('swaggervel.doc-route')),
        'requestHeaders' => Config::get('swaggervel.requestHeaders'),
        'clientId' => Input::get('client_id'),
        'clientSecret' => Input::get('client_secret'),
        'realm' => Input::get('realm'),
        'appName' => Input::get('appName'),
    ]);

    //need the / at the end to avoid CORS errors on Homestead systems.
    /*$response = Response::make(
        View::make('swaggervel::index', array(
                'secure' => Request::secure(),
                'urlToDocs' => url(Config::get('swaggervel.doc-route')),
                'requestHeaders' => Config::get('swaggervel.requestHeaders') )
        ),
        200
    );*/

    if (Config::has('swaggervel.viewHeaders')) {
        foreach (Config::get('swaggervel.viewHeaders') as $key => $value) {
            $response->header($key, $value);
        }
    }

    return $response;
});
