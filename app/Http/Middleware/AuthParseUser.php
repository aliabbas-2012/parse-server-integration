<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Parse\ParseUser;
use Parse\ParseException;
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
        $error_message = "";
        try {
            if($user = ParseUser::become($request->header('AUTHORIZATION'))){
                $request->user = $user;
                return $next($request);
            }

        } catch (ParseException $ex) {
            $error_message = $ex->getMessage();
        }
        return response()->json(['error' => 'UnAuthorized.', 'message' => $error_message], 401);
    }
}
