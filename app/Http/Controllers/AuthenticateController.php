<?php

namespace App\Http\Controllers;


use Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\User;


class AuthenticateController extends Controller
{

    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email' => 'required|max:25|email',
        'password' => 'required|min:3',
        ]);

            if($validator->fails())
            {
                return $validator->messages()->toJson();
            }
        
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function signup(Request $request)
    {
         $validator = Validator::make($request->all(), [
        'email' => 'required|max:25|email',
        'password' => 'required|min:3|confirmed',
        'password_confirmation' => 'required|min:3',
        ]);

            if($validator->fails())
            {
                return $validator->messages()->toJson();
            }
         $credentials = $request->only('email','name');

       try {
           $user = User::create(['password' => bcrypt($request->password), 'email' =>  $request->email,  'name' => $request->name]);
       } catch (\Illuminate\Database\QueryException $e) {
           return response()->json(['error' => 'User already exists.'], Response::HTTP_CONFLICT);
       }

       $token = JWTAuth::fromUser($user);

       return response()->json(compact('token'));   
    }
      
}
