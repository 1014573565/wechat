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

Route::any('/wechat', 'WeChatController@serve');

Route::any('/wechat/list', 'WeChatController@rsList');
Route::any('/wechat/stats', 'WeChatController@rsStats');
Route::any('/wechat/del/{mediaId}', 'WeChatController@rsDel');



Route::any('/wechat/menu/create', 'WeChatController@createMenu');
Route::any('/wechat/material/upload', 'WeChatController@upload');


Route::any('/wechat/login', 'WeChatController@login');
Route::any('/wechat/register', 'WeChatController@register');
Route::any('/wechat/login1', 'WeChatController@login1');
Route::any('/wechat/modifyPassword', 'WeChatController@modifyPassword');


Route::group(['middleware' => ["wechat"]], function () {
    Route::any('/wechat/check', 'WeChatController@checkSessionID');
    Route::any('/wechat/query', 'WeChatController@query');
    Route::any('/wechat/message', 'WeChatController@templateMessage');
});



/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
