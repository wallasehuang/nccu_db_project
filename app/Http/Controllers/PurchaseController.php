<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Product;
use Redirect;
use Response;
use Validator;
use View;
use Auth;

class PurchaseController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $purchase = Purchase::all();
        return view('purchase.list')->withAction('purchase')->withPurchases($purchase);
    }

    public function add(){
        $product = Product::all();
        return view('purchase.add')->withAction('add')->withProducts($product);
    }

    public function add_func(){
        $data  = Input::all();
        $rules = array(
            'productId' => 'required',
            'quantity' => 'required|integer'
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::to('purchase/add')->withErrors($validator, 'add_func');
        } else {
            Purchase::create([
                'productId' => $data['productId'],
                'quantity' => $data['quantity'],
                'userId' => Auth::user()->id,
                ]);
        }
        return Redirect::to('purchase/list');
    }
}
