<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Product;
use Redirect;
use Response;
use Validator;
use View;

class InventoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $product = Product::all();
        return view('inventory.list')->withAction('product')->withProducts($product);
    }
}
