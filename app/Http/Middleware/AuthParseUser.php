<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Parse\ParseUser;
class AuthParseUser
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle(Request $request, Closure $next)
    {
        if($user = ParseUser::become($request->header('AUTHORIZATION'))){
            return $next($request);
        }
    }
}
