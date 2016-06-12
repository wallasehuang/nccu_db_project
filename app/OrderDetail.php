<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    //
	protected $table = 'orderDetails';

	protected $fillable = array('id', 'orderId', 'productId', 'quantity');

	public function orders(){
		return $this->belongsTo('App\Order','orderId','id');
	}

	public function product(){
		return $this->belongsTo('App\Product','productId','id');
	}
}
