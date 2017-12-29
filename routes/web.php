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
Route::get('/users', [
    'uses' => 'UserController@anyData',
    'as' => 'user.list'
]);
Route::resource('/sucursal', 'SucursalController');
Route::get('/sucursal/{id}/delete', [
    'uses' => 'SucursalController@destroy',
    'as' => 'sucursal.destroy'
]);
Route::get('/sucursales', [
    'uses' => 'SucursalController@anyData',
    'as' => 'sucursal.list'
]);
Route::resource('/cliente', 'ClienteController');
Route::get('/cliente/{id}/delete', [
    'uses' => 'ClienteController@destroy',
    'as' => 'cliente.destroy'
]);
Route::get('/clientes', [
    'uses' => 'ClienteController@anyData',
    'as' => 'cliente.list'
]);
Route::get('/cliente/buscar/sh', [
    'uses' => 'ClienteController@buscar',
    'as' => 'cliente.buscar'
]);
Route::get('/cliente/{id}/tratamiento', [
    'uses' => 'ClienteController@tratamientos',
    'as' => 'cliente.tratamientos'
]);
Route::get('/cliente/tratamiento/add', [
    'uses' => 'ClienteController@addTratamiento',
    'as' => 'cliente.tratamiento.add'
]);
Route::get('/cliente/{id}/saldo', [
    'uses' => 'ClienteController@saldo',
    'as' => 'cliente.saldo'
]);
Route::get('/ct/{id}/abonar', [
    'uses' => 'ClienteController@abonar',
    'as' => 'cliente.abonar'
]);

Route::resource('/tratamiento', 'TratamientoController');
Route::get('/tratamiento/{id}/delete', [
    'uses' => 'TratamientoController@destroy',
    'as' => 'tratamiento.destroy'
]);
Route::get('/tratamientos', [
    'uses' => 'TratamientoController@anyData',
    'as' => 'tratamiento.list'
]);
Route::resource('/reserva', 'ReservaController');
Route::post('/reserva/editar/{id}', [
    'uses' => 'ReservaController@editar',
    'as' => 'reserva.editar'
]);
Route::post('/reserva/estado/{id}', [
    'uses' => 'ReservaController@estado',
    'as' => 'reserva.estado'
]);
Route::get('/reserva/{id}/delete', [
    'uses' => 'ReservaController@destroy',
    'as' => 'reserva.destroy'
]);
Route::resource('/rotativo', 'RotativoController');
Route::get('/rotativos', [
    'uses' => 'RotativoController@anyData',
    'as' => 'rotativo.list'
]);
Route::get('/rotativo/{id}/delete', [
    'uses' => 'RotativoController@destroy',
    'as' => 'rotativo.destroy'
]);
Route::get('/rotativo/{sucursal}/{tratamiento}', [
    'uses' => 'RotativoController@valid',
    'as' => 'rotativo.valid'
]);
