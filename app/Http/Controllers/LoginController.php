<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $intended_url = $request->session()->get('url.intended');
        session()->put('intended_url', $intended_url);

        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('login');
        }
    }

    public function do_login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'password' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('/dashboard');
        } else {
            return redirect('/login')->with('status', 'Incorrect Username or password!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
