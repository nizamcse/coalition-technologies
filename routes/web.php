<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('default');

Route::post('create-product',[
    'uses'  => 'ProductController@store',
    'as'    => 'create-product'
]);

Route::get('product-list',[
    'uses'  => 'ProductController@getProducts',
    'as'    => 'product-list'
]);

Route::get('get-product/{id?}',[
    'uses'  => 'ProductController@getProduct',
    'as'    => 'get-product'
]);

Route::post('update-product/{id?}',[
    'uses'  => 'ProductController@update',
    'as'    => 'update-product'
]);

Route::get('delete-product/{id}',[
    'uses'  => 'ProductController@delete',
    'as'    => 'delete-product'
]);
