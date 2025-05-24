<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function viewEmployeeLogin()
    {
        return view('pages.auth.login-employee');
    }

    public function viewShiftLeaderLogin()
    {
        return view('pages.auth.login-shift-leader');
    }

    public function employeeLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('employee')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function shiftLeaderLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('shift_leader')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function employeeLogout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('employee.login.view');
    }

    public function shiftLeaderLogout(Request $request)
    {
        Auth::guard('shift_leader')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('shift-leader.login.view');
    }
}
