<?php

use Illuminate\Http\Request;

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

/**
 * 需要登录权限的接口
 * 需要在header带上Authorization参数
 */
Route::middleware('jwt.auth')->group(function() {

    Route::prefix('user')->group(function() {

        Route::post('logout', 'UserController@logout');                                                         //  登出

    });

});

//  用户路由
Route::prefix('user')->group(function() {

    Route::post('login', 'UserController@login');                                                               //  登录

    Route::post('register', 'UserController@regist');                                                           //  注册

});

//  测试路由
Route::get('test1', 'TestController@test1');
Route::get('test2', 'TestController@test2');
Route::get('test3', 'TestController@test3');
Route::get('test4', 'TestController@test4');
Route::get('test5', 'TestController@test5');
Route::get('test6', 'TestController@test6');
Route::get('test7', 'TestController@test7');


//  错误返回
Route::fallback(function (){
    return response()->json(['message' => 'Not Found!', 'code' => 404], 404);
});