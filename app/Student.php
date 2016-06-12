<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    //
    protected $table = 'students';

    protected $fillable = array('id', 'studentNo', 'name', 'phone');

    public function order(){
        return $this->hasMany('App\Order', 'studetnId', 'id');
    }
}
