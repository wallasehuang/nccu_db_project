<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Order;
use App\Student;
use App\OrderDetail;
use Redirect;
use Response;
use Validator;
use View;
use Auth;

class OrderController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $order = Order::all();
        return view('order.list')->withAction('order')->withOrders($order)->withAuth(Auth::user());
    }

    public function add(){
        $student = Student::all();
        return view('order.add')->withAction('add')->withStudents($student);
    }

    public function add_func(){
        $data  = Input::all();
        $rules = array(
            'studentId' => 'required',
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('order/add')->withErrors($validator, 'add_func');
        } else {
            $id = Order::create([
                'studentId' => $data['studentId'],
                'userId' => Auth::user()->id,
                ])->id;
            Order::find($id)->update(['orderNo'=>$id]);
        }
        return Redirect::to('order/detail?id='.$id);
    }

    public function del_func(){
        $id = Input::get('id');
        OrderDetail::where('orderId',$id)->delete();
        Order::destroy($id);
        return Redirect::to('order/list');
    }
}
