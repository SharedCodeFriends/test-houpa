<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JwtController extends Controller
{
    public function login(Request $request){
        $credentials = $request->all('email', 'password');

        if(auth('api')->attempt($credentials)){
            return response()->json(['token' => auth('api')->attempt($credentials)], 200);
        }else{
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}
