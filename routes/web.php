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
    return view('auth.login2');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/user', 'UserController');
Route::get('/user/{id}/delete', [
    'uses' => 'UserController@destroy',
    'as' => 'user.destroy'
]);
Route::resource('/sucursal', 'SucursalController');
Route::get('/sucursal/{id}/delete', [
    'uses' => 'SucursalController@destroy',
    'as' => 'sucursal.destroy'
]);
Route::resource('/cliente', 'ClienteController');
Route::get('/cliente/{id}/delete', [
    'uses' => 'ClienteController@destroy',
    'as' => 'cliente.destroy'
]);
