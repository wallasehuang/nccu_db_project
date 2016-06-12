<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;
use Redirect;
use Response;
use Validator;
use View;
use Auth;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = User::all();

        return view('account.list')->withAction('account')->withUsers($user)->withAuth(Auth::User());
    }

    public function add(){
        return view('account.add')->withAction('add');
    }

    public function add_func(){
        $data  = Input::all();
        $rules = array(
            'name' => 'required|max:255',
            'account' => 'required|max:255',
            'password' => 'required|confirmed',
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('account/add')->withErrors($validator, 'store');
        } else {
            User::create([
                'name' => $data['name'],
                'account' => $data['account'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'role' => $data['role'],
                'status' => 1,
                ]);
        }
        return Redirect::to('account/list');
    }

    public function edit(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $user = User::find(Input::get('id'));
            return view('account.edit')->withAction('edit')->withUser($user);
        }
    }

    public function edit_func(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $rules = array(
                'name' => 'required|max:255',
                'account' => 'required|max:255',
                'phone' => 'required',
                );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::to('account/edit?id='.Input::get('id'))->withErrors($validator, 'edit');
            } else {
                $id = Input::get('id');
                User::find($id)->update(Input::all());
                return Redirect::to('account/list');
            }

        }
        return Response::json([
            'Message' => 'Success',
            ], 200);
    }

    public function state(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $status = User::find(Input::get('id'))->status;
            if($status == 1){
                $status = 0;
            }else{
                $status = 1;
            }
            User::find(Input::get('id'))->update(['status'=>$status]);
        }
        return Response::json([
            'Message' => 'Success',
            ], 200);
    }

    public function check(){
        if (Input::has('id') == null) {
            $rules = array(
                'account' => 'unique:users,account',
            );
        } else {
            $rules = array(
                'account' => 'unique:users,account,' . Input::get('id'),
            );
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return "false";
        } else {
            return "true";
        }
    }
}
