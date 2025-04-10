<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if(!empty(Auth::check())){
            return redirect('panel/dashboard');
        }
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $remember = !empty($request->remember);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('message', 'Invalid credentials');
    }

    public function logout(){
        Auth::logout();
            return redirect(url(''));
    }
}
