<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginAttempt(Request $request) {
        $user=DB::table('users')->where('email',$request->input('email'))->first();
        if ($user) {
            if ($request->input('password') === $user->password) {
                session(['user' => $user]);
                return redirect()->route('index');
            } else {
                return redirect()->back()->with('error_login', true);
            }
        }
        else {
            return redirect()->back()->with('error_login', true);
        }
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
}
