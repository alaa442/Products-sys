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
Route::resource('/company','CompanyController');
Route::get('/company/destroy/{id}','CompanyController@destroy');
Route::post('importcomoany','CompanyController@importcompany');	
Route::get('/fupdate','CompanyController@fupdate');


Route::resource('/selleroffice','SellerOfficeController');
Route::get('/selleroffice/destroy/{id}','SellerOfficeController@destroy');
Route::get('/fupdate','SellerOfficeController@fupdate');


Route::resource('/activity','ActivityController');
Route::get('/activity/destroy/{id}','ActivityController@destroy');
Route::get('/ACupdate','ActivityController@ACupdate');
Route::post('/importactivity','ActivityController@importactivity');


Route::resource('/product','ProductController');
Route::get('/product/destroy/{id}','ProductController@destroy');
Route::post('/importproduct','ProductController@importproduct');

Route::resource('/promoter','PromoterController');

Route::get('/', function () {
    return view('welcome');
});
