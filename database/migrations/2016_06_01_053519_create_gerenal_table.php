<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGerenalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->unique();
            $table->string('name');
            $table->string('password');
            $table->string('phone');
            $table->tinyInteger('role');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });

         Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('studentNo',9)->unique();
            $table->string('name');
            $table->string('phone');
            $table->timestamps();
        });

         Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('price');
            $table->timestamps();
        });

         Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userId');
            $table->string('productId');
            $table->integer('quantity');
            $table->timestamps();
        });

         Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderNo',9)->unique();
            $table->string('studentId');
            $table->string('userId');
            $table->timestamps();
        });

         Schema::create('orderDetails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderId');
            $table->string('productId');
            $table->integer('quantity');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('students');
        Schema::drop('products');
        Schema::drop('purchases');
        Schema::drop('orders');
        Schema::drop('orderDetails');
    }
}
