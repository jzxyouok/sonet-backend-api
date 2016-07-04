<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function create(Request $request)
    {
    	User::create([
    		'password' => bcrypt($request->password), 
    		'email' =>  $request->email,
    		'name' => $request->name
    		]);
    }

    public function currentUser()
    {
    	return $user = JWTAuth::parseToken()->authenticate();
    }
    
    
}
