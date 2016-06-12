<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;
use Redirect;
use Response;
use Validator;
use View;
use Auth;

class DetailController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
       if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $order = Order::find(Input::get('id'));
            return view('detail.list')->withAction('orderDetail')->withOrder($order)->withAuth(Auth::user());
        }
    }

    public function add(){
        $product = Product::all();
        return view('detail.add')->withAction('add')->withProducts($product)->withId(Input::get('id'));
    }

    public function add_func(){
        $data  = Input::all();
        $rules = array(
            'productId' => 'required',
            'quantity' => 'required|integer'
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('order/detail/add?id='.Input::get('id'))->withErrors($validator, 'add_func');
        } else {
            OrderDetail::create([
                'orderId' => Input::get('id'),
                'productId' => $data['productId'],
                'quantity' => $data['quantity'],
                ]);
        }
        return Redirect::to('order/detail?id='.Input::get('id'));
    }

    public function edit(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $detail = orderDetail::find(Input::get('id'));
            $product = Product::all();
            return view('detail.edit')->withAction('edit')->withOrderDetail($detail)->withProducts($product);
        }
    }

    public function edit_func(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
                ], 500);
        } else {
            $rules = array(
                'productId' => 'required',
                'quantity' => 'required|integer'
                );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::to('order/detail/edit?id='.Input::get('id'))->withErrors($validator, 'edit');
            } else {
                $id = Input::get('id');
                OrderDetail::find($id)->update(Input::all());
                return Redirect::to('order/detail?id='.Input::get('orderId'));
            }

        }
        return Response::json([
            'Message' => 'Success',
            ], 200);
    }

    public function del_func(){
        $id = Input::get('id');
        $orderId = Input::get('orderId');
        OrderDetail::destroy($id);
        return Redirect::to('order/detail?id='.$orderId);
    }
}
