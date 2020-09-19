<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','FrontendController@index')->name('index'); 
Auth::routes(); 

Route::get('/home', 'HomeController@index')->name('home'); 

Route::get('brand/{id}', 'FrontendController@brand')->name('brand'); 

Route::get('promotion', 'FrontendController@promotion')->name('promotion'); 

Route::get('cart','FrontendController@cart')->name('cart');


Route::get('detail/{id}','FrontendController@detail')->name('detail');

Route::get('subcategory/{id}','FrontendController@subcategory')->name('subcategory');

Route::post('order','FrontendController@order')->name('order');

Route::post('search','FrontendController@search')->name('search');

Route::get('ordersuccess','FrontendController@ordersuccess')->name('ordersuccess');

Route::get('orderlist','OrderController@orderlist')->name('orderlist');

Route::get('orderdetail/{id}','OrderController@orderdetail')->name('orderdetail');





//Basic Route
//Get Method
Route::get('hello','TestOneController@index'); 
//Post Method
Route::post('hello','TestOneController@index'); 

//for all method (get,post,update, delete, add, patch)
Route::resource('test','TestTwoController'); 

//route parameter
Route::get('user/{id}','TestThreeController@show'); 
//multiple route parameter
Route::get('hellouser/{name}/{position}/{city}','TestOneController@user');  
//backkend
Route::group(['middleware'=>'role:admin','prefix'=>'backside','as'=>'backside.'],function(){
Route::resource('/category','CategoryController'); 
Route::resource('/subcategory','SubcategoryController');  
Route::resource('/brand','BrandController'); 
Route::resource('/item','ItemController');
Route::resource('/township','TownshipController'); 



});









