<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    //
	protected $table = 'products';

	protected $fillable = array('id', 'name','cost', 'price');

	public function purchase(){
		return $this->hasMany('App\Purchase','productId','id');
	}

	public function orderDetail(){
		return $this->hasMany('App\OrderDetail', 'productId', 'id');
	}
}
