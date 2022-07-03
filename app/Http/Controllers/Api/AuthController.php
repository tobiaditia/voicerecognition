<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $user = Auth::user();
            $success['user'] =  $user;
            $success['token'] = $user->createToken('authToken')->accessToken;

            return response()->json($success);

        }
        else{
            return response()->json(['error'=>'Unauthorised']);
        }
    }
}
