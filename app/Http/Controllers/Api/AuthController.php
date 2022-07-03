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
            $success['token'] = $user->createToken('authToken')->accessToken;
            $success['name'] =  $user->name;

            return response()->json($success);

        }
        else{
            return response()->json(['error'=>'Unauthorised']);
        }

        // if ($user && Hash::check($request->password, $user->password)) {
        //     $accessToken = $user->createToken('authToken')->accessToken;
        //     $user->save();

        //     return $this->response->send(200, ['user' => new UserResource($user), 'token' => $accessToken]);

        // } else {
        //     return $this->response->send(401, null, "Email and password not match");
        // }
    }
}
