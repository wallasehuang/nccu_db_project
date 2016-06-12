<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    //
    protected $table = 'orders';

    protected $fillable = array('id', 'orderNo', 'studentId','userId', 'date');

    public function setOrderNoAttribute($value){
		$this->attributes['orderNo'] = date("ymd").str_pad($value,3,'0',STR_PAD_LEFT);
	}

	public function orderDetail(){
        return $this->hasMany('App\OrderDetail','orderId','id');
   }

   public function student(){
        return $this->belongsTo('App\Student','studentId','id');
   }

   public function user(){
    return $this->belongsTo('App\User','userId','id');
    }

}
