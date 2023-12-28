<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function main_page()
    {
        return redirect('/login');
    }

    public function login_form()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $password = User::where('email','=',$request->email)->pluck('password');
        $id = User::where('email','=',$request->email)->pluck('id');

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            Auth::loginUsingId($id);            
            // return redirect('/home');
            return view('layouts.master');
        }
        else
        {
            return redirect('/login')->with('error','Terjadi kesalahan login, Periksa Email dan Password Anda');
        }
    }
}
