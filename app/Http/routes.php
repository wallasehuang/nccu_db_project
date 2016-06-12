<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('login','LoginController@show');
Route::post('login','LoginController@login');
Route::get('logout','LoginController@logout');

Route::get('install','InstallController@index');

Route::get('/', 'HomeController@index');

Route::group(array('prefix' => 'account'), function () {
    Route::get('list', "AccountController@index");
    Route::get('add', "AccountController@add");
    Route::post('add', "AccountController@add_func");
    Route::get('edit', "AccountController@edit");
    Route::post('edit', "AccountController@edit_func");
    Route::post('state', "AccountController@state");
    Route::get('check', "AccountController@check");
 });
Route::group(array('prefix' => 'product'), function () {
    Route::get('list', "ProductController@index");
    Route::get('add', "ProductController@add");
    Route::post('add', "ProductController@add_func");
    Route::get('edit', "ProductController@edit");
    Route::post('edit', "ProductController@edit_func");
 });
Route::group(array('prefix' => 'student'), function () {
    Route::get('list', "StudentController@index");
    Route::get('add', "StudentController@add");
    Route::post('add', "StudentController@add_func");
    Route::get('edit', "StudentController@edit");
    Route::post('edit', "StudentController@edit_func");
    Route::get('check', "StudentController@check");
 });
Route::group(array('prefix' => 'purchase'), function () {
    Route::get('list', "PurchaseController@index");
    Route::get('add', "PurchaseController@add");
    Route::post('add', "PurchaseController@add_func");
});
Route::group(array('prefix' => 'order'), function () {
    Route::get('list', "OrderController@index");
    Route::get('add', "OrderController@add");
    Route::post('add', "OrderController@add_func");
    Route::get('del', "OrderController@del_func");
    Route::get('detail', "DetailController@index");
    Route::get('detail/add', "DetailController@add");
    Route::post('detail/add', "DetailController@add_func");
    Route::get('detail/edit', "DetailController@edit");
    Route::post('detail/edit', "DetailController@edit_func");
    Route::get('detail/del', "DetailController@del_func");
});
Route::get('inventory','InventoryController@index');

