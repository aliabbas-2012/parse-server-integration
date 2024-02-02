<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Parse\ParseUser;
use Parse\ParseException;

class IndexController extends Controller
{
    public  function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = new ParseUser();
        $user->setUsername($request->get('username'));
        $user->setPassword($request->get('password'));
        $user->setEmail($request->get("email"));

        // try to register if not then go for login
        try {
            $user->signUp();
        } catch (ParseException $ex) {
            // error in $ex->getMessage();
        }

        // try to do login
        try {
            $user = ParseUser::logIn($request->get('username'), $request->get('password'));
        } catch (ParseException $ex) {
            return response(['error'=>$ex->getMessage()], 401);
        }

        $response = ['token' => $user->getSessionToken()];
        return response($response, 200);
    }

    public  function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        // try to do login
        try {
            $user = ParseUser::logIn($request->get('username'), $request->get('password'));
        } catch (ParseException $ex) {
            return response(['error'=>$ex->getMessage()], 401);
        }

        $response = ['token' => $user->getSessionToken()];
        return response($response, 200);
    }

}
