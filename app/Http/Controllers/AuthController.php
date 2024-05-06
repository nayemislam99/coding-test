<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{

    /**
     *User login index.
     */
    public function index(){
        return view('auth.login');
    }


    /**
     *User authentication.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $authCredentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($authCredentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Credentials do not match our records.',
        ])->onlyInput('email');
    }


/**
 * Logout user.
 */
public function logout(Request $request): RedirectResponse
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return to_route('auth.login');
}
}
