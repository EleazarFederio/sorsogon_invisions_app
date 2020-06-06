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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'CustomerController@index')->name('home');
Route::get('settings', 'SettingsController@index');

//Route::Resource('/products', 'ProductController');
Route::Resource('/employees', 'EmployeeController');
Route::Resource('/customers', 'CustomerController'
);

Route::group(['prefix' => 'customers'], function () {
    Route::Resource('/{customers}/products', 'ProductController', [
        'only' => ['show', 'store', 'update', 'destroy']
    ]);
});

Route::get('/products_all', 'ProductController@showAll');
Route::group(['prefix' => 'products', 'middleware' => 'auth'], function () {
    Route::resource('/{product}/process', 'ProcessController', [
        'only' => [ 'show', 'store', 'update', 'destroy']
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
