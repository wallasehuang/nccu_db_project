<?php
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    protected $table = 'users';

    protected $fillable = ['id', 'account', 'name', 'password', 'phone', 'role', 'status'];

    protected $hidden = ['password', 'remember_token'];

    public function purchase(){
        return $this->hasMany('App\Purchase','userId','id');
    }
    public function order(){
        return $this->hasMany('App\Order','userId','id');
    }



}
