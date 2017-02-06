<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        if ($request->isMethod('post')) {
            Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
                return Hash::check($value, current($parameters));
            });
            $this->validate($request, [
                'old_password' => 'required|old_password:' . Auth::user()->password,
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8'
            ]);

            $user = Auth::user();
            $user->password = Hash::make($request->input('password'));
            $user->save();

            $request->session()->flash('success', 'The password is successfully changed.');
            return redirect()->back();
        }
        
        return view('auth.passwords.change', ['mode' => 'edit', 'formAction' => '/password/change']);
    }
}
