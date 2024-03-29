<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request) {
        $response = ['message' => 'Welcome to Parse Server Client'];
        return response($response, 200);
    }
}
