<?php
/**
 * Created by PhpStorm.
 * User: some
 * Date: 2018/5/2
 * Time: 下午8:05
 */

//$routeFunc = function () {
    Route::any('/login', "Proto\SecurityController@SignIn");


//Users Management
    Route::group(['middleware' => ['auth']], function () {
        //首页
        Route::get('/', "Proto\HomeController@Index");
        #注销
        Route::any('/loginOut', "Proto\SecurityController@SignOut");
        Route::any('/jobs', "Proto\JobsController@index");

        #设置
        Route::match(["get", "post"], "/pages-user-profile", "Proto\AdminController@Settings");


        Route::match(["get", "post"], '/proto/admin', "Proto\AdminController@Admin");
        Route::match(["get", "post"], '/proto/admin/add', "Proto\AdminController@AddAction");
        Route::match(["get", "post"], '/proto/admin_modal/{admin_id}', "Proto\AdminController@adminModal");
        Route::match(["get", "post"], '/proto/admin/edit', "Proto\AdminController@EditAction");
        Route::match(["get", "post"], '/proto/admin/del', "Proto\AdminController@DeleteAdminUser");


        Route::match(["get", "post"], '/proto/driver', "Proto\DriverController@Admin");
        Route::match(["get", "post"], '/proto/driver/add', "Proto\DriverController@AddAction");
        Route::match(["get", "post"], '/proto/driver_modal/{driver_id}', "Proto\DriverController@adminModal");
        Route::match(["get", "post"], '/proto/driver/edit', "Proto\DriverController@EditAction");
        Route::match(["get", "post"], '/proto/driver/del', "Proto\DriverController@DeleteAdminUser");

    });
//};

/*Route::group(['domain' => "www.bclould.com"], $routeFunc);
Route::group(['domain' => "bclould.qianbi.today"], $routeFunc);
Route::group(['domain' => "www.topperchat.com"], $routeFunc);*/

