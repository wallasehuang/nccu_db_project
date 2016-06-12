<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Product;
use Redirect;
use Response;
use Validator;
use View;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $product = Product::all();
        return view('product.list')->withAction('product')->withProducts($product);
    }

    public function add(){
        return view('product.add')->withAction('add');
    }

    public function add_func(){
        $data  = Input::all();
        $rules = array(
            'name' => 'required|max:255',
            'cost' => 'required|integer',
            'price' => 'required|integer',
        );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('product/add')->withErrors($validator, 'add_func');
        } else {
            Product::create([
                'name' => $data['name'],
                'cost' => $data['cost'],
                'price' => $data['price'],
            ]);
        }
        return Redirect::to('product/list');
    }

    public function edit(){
        if (Input::has('id') == null) {
            return Response::json([
                'Message' => 'ERROR ID',
            ], 500);
        } else {
            $product = Product::find(Input::get('id'));
            return view('product.edit')->withAction('edit')->withProduct($product);
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
                'cost' => 'required|integer',
                'price' => 'required|integer',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                return Redirect::to('product/edit?id='.Input::get('id'))->withErrors($validator, 'edit');
            } else {
                $id = Input::get('id');
                Product::find($id)->update(Input::all());
                return Redirect::to('product/list');
            }

        }
        return Response::json([
            'Message' => 'Success',
        ], 200);
    }
}
