<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'api' => [
            'cors:api',
            'json.response:api',
            'throttle:api',
            'initialize.parse.client:api',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth.parse.user' =>  \App\Http\Middleware\AuthParseUser::class,
        'cors' => \App\Http\Middleware\Cors::class,
        'initialize.parse.client' => \App\Http\Middleware\InitializeParseClient::class,
        'json.response' => \App\Http\Middleware\ForceJsonResponse::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
