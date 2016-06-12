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

class InstallController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(){
        $account = 'root';
        $password = 'root';
        $role = 15;
        $status = 1;
        $data  = array(
            'name' => 'root',
            'account' => $account,
            'phone' => '0900000000',
            'password' => bcrypt($password),
            'role' => $role,
            'status' => $status,
            );
        $rules = array(
            'name' => 'required|max:255|',
            'account' => 'required|max:255|unique:users,account',
            'password' => 'required',
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            User::create($data);
        }
        return 'success';

    }
}
