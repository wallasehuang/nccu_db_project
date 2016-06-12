<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class LoginController extends Controller
{
    public function show(){
        return view('auth.login');
    }

    public function login(){
        $input = Input::all();
        $rules = ['account'=>'required','password'=>'required'];
        $validator = Validator::make($input, $rules);
        if ($validator->passes()) {
            $attempt = Auth::attempt([
                'account' => $input['account'],
                'password' => $input['password'],
                'status' => 1
        ]);
        if ($attempt) {
            return Redirect::to('/');
        }
        return Redirect::to('login')->withErrors(['fail'=>'account or password is wrong!']);
    }
        //fails
        return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
        }

    public function logout(){
        Auth::logout();
        return Redirect::to('login');
    }
}
