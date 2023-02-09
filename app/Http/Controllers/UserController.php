<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('dashboard.login');
    }

    public function authenticate(Request $request) {

        // dd(bcrypt(12345));
        // Validating credentials
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard')->with('message', 'You have been logged in');
        }
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        
    }

    public function logout(Request $request) 
    {


        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'))->with('message', 'You have been logged out');
    }
}
