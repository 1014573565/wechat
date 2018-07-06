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



Route::any('/login', "Proto\SecurityController@SignIn")->name('login');


//Users Management
Route::group(['middleware' => ['auth']], function () {
    //首页
    Route::get('/', "Proto\HomeController@Index");
    #注销
    Route::any('/loginOut', "Proto\SecurityController@SignOut");
    Route::any('/jobs', "Proto\JobsController@index");
    Route::match(["get", "post"], '/proto/jobs/del', "Proto\JobsController@DeleteAdminUser");
    Route::match(["get", "post"], '/proto/jobs/upload', "Proto\JobsController@upload");
    Route::match(["get", "post"], '/proto/jobs/upload_action', "Proto\JobsController@insertExcelData");

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
    Route::match(["get", "post"], '/proto/driver/upload', "Proto\DriverController@upload");
    Route::match(["get", "post"], '/proto/driver/upload_modal/{file_name}', "Proto\DriverController@uploadModal");
    Route::match(["get", "post"], '/proto/driver/upload_action', "Proto\DriverController@insertExcelData");


    Route::match(["get", "post"], '/proto/guide', "Proto\GuideController@Admin");
    Route::match(["get", "post"], '/proto/guide/add', "Proto\GuideController@AddAction");
    Route::match(["get", "post"], '/proto/guide_modal/{driver_id}', "Proto\GuideController@adminModal");
    Route::match(["get", "post"], '/proto/guide/edit', "Proto\GuideController@EditAction");
    Route::match(["get", "post"], '/proto/guide/del', "Proto\GuideController@DeleteAdminUser");


    Route::match(["get", "post"], '/proto/remove/excel', "Proto\HomeController@removeExcel");
});
