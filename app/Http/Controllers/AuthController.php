<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:web',['except'=>['logout']]);
    }

    public function index()
    {
        return view('pages.user-pages.login');
    }

    public function login(Request $request)
    {

        $validator = Validator::make([], []);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (Auth::user()->role_id <= 2) {
                return redirect(route('dashboard'));
            }else{
                $validator->errors()->add('password', 'User tidak ada');
            }
        }else{
            $validator->errors()->add('password', 'This is wrong password');
        }
        throw new ValidationException($validator);
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
