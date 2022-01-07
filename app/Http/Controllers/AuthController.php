<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function loginNow(Request $request)
    {
        $rules = [
            'password' => 'required'
        ];

        if ($request->type == 'user') {
            $rules['email'] = 'required';
        } elseif ($request->type == 'admin') {
            $rules['email'] = 'required';
        }
        $request->validate($rules);

        if ($request->type == 'user') {
            if (Auth::guard('user')->attempt(['email'=>$request->email,'password'=>$request->password])) {

                if (Auth::guard('user')->check()) {
                    return redirect()->route('user.dashboard');
                } else {
                    return redirect()->route('user.login');
                }

            } else {
                return back()->withErrors(['password'=>'Wrong email and password']);
            }
        } elseif ($request->type == 'admin') {
            if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])) {

                if (Auth::guard('admin')->check()) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('admin.login');
                }

            } else {
                return back()->withErrors(['password'=>'Wrong email and password']);
            }
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
