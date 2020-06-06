<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('employee_register', "Api\ApiEmployeeController@register");
Route::post('employee_login', "Api\ApiEmployeeController@login");
Route::get('product_list', 'Api\ApiProductController@productList');
//Route::apiResource('product', 'Api\ApiProductController');


Route::group(['prefix' => 'product'], function () {
    Route::apiResource('/{product}/process', 'Api\ApiProcessController',[
        'only' => ['index']
    ]);
});

Route::Resource('/customers', 'Api\ApiCustomerController');
Route::group(['prefix' => 'customers'], function () {
    Route::apiResource('/{customers}/products', 'Api\ApiProductController',[
        'only' => ['index','show']
    ]);
});


//Route::group(['prefix' => 'employee'], function () {
//    Route::apiResource('/{employee}/process', 'Api\ApiProcessController',[
//        'only' => ['update', 'store']
//    ]);
//});