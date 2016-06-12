<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    //
    protected $table = 'purchases';

    protected $fillable = array('id', 'userId', 'productId', 'quantity');

    public function user(){
   	return $this->belongsTo('App\User','userId','id');
    }

    public function product(){
   	return $this->belongsTo('App\Product','productId','id');
    }
}
