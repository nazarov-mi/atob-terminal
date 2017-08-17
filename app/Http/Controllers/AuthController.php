<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
    	if (Auth::attempt([
    		'username' => $request->username,
    		'password' => $request->password
    	])) {
    		return redirect('/');
    	}

        return back()->with('error', 'Неправильный логин или пароль');
    }

    public function login()
    {
        if (Auth::check()) return back();
        
        return view('auth.login');
    }

    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }
}
