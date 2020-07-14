<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Auth;
use Activity;

class AuthController extends Controller
{
    use ThrottlesLogins;

    public function username()
    {
        return 'username';
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validator($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if (Auth::guard('admin')->attempt($request->only($this->username(), 'password'), $request->filled('remember'))) {
            Activity::add(['page' => 'Login', 'description' => 'Masuk Ke Website']);

            return redirect()->route('admin.home')->with('status', 'You are Logged in as Admin!');
        }

        $this->incrementLoginAttempts($request);

        return $this->loginFailed();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('status', 'Admin has been logged out!');
    }
    private function validator(Request $request)
    {
        $rules = [
            $this->username() => 'required|string|exists:admins|min:4|max:191',
            'password'        => 'required|string|min:6|max:255',
        ];

        $messages = [
            $this->username() . '.exists' => 'These credentials do not match our records.',
        ];

        $request->validate($rules, $messages);
    }

    private function loginFailed()
    {
        return redirect()->back()->withInput()->withErrors([
            'password' => 'Wrong password!',
        ]);
    }
}
