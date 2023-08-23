<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if(Auth::guard('admin')->attempt($credentials)) {
            if(auth()->guard('admin')->user()->role == 0)
            {
                return redirect()->route('adminDashboard');
            }
            elseif(auth()->guard('admin')->user()->role == 1)
            {
                return redirect()->route('showCOA',['id' => 0]);
            }
        }
        return redirect()->back()->withError('Wrong Credentials');
        
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginForm');
    }
}
