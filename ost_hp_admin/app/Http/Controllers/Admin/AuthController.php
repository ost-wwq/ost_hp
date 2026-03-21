<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.contacts.index');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $correct = Hash::check($request->password, config('admin.password_hash'));

        if (!$correct) {
            return back()->withErrors(['password' => 'パスワードが正しくありません。']);
        }

        $request->session()->put('admin_logged_in', true);
        $request->session()->regenerate();

        return redirect()->route('admin.contacts.index');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}
