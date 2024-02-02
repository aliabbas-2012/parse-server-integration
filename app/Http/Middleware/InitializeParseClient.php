<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Parse\ParseClient;
class InitializeParseClient
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        ParseClient::initialize(env('PARSE_APP_ID'), env('PARSE_REST_KEY'), env('PARSE_MASTER_KEY'));
        ParseClient::setServerURL(env('PARSE_SERVER_URL'),'/');

        return $next($request);
    }
}
