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
    return view('dashboard');
	$model = \DB::table('user_list_v')->get();
	dd($model);
});

Route::get('/', 'AuthController@index')->middleware('customRedirectIfNotAuthenticated', 'customRedirectIfAuthenticated');

Route::get('/login', 'AuthController@index')->middleware('customRedirectIfAuthenticated');

Route::get('/logout', 'AuthController@logout');

Route::post('post-login', 'AuthController@postLogin');

Route::any('/dashboard', 'DashboardController@index')->middleware('customRedirectIfNotAuthenticated');

Route::group(['prefix' => 'asset', 'middleware' => 'customRedirectIfNotAuthenticated'], function() {
    Route::group(['prefix' => 'master-organization'], function() {
        Route::any('/', 'Asset\MasterOrganizationController@index');
        Route::get('add', 'Asset\MasterOrganizationController@add');
        Route::get('edit/{id}', 'Asset\MasterOrganizationController@edit');
        Route::post('save', 'Asset\MasterOrganizationController@save');
        Route::post('delete', 'Asset\MasterOrganizationController@delete');
    });
    Route::group(['prefix' => 'master-category'], function() {
        Route::any('/', 'Asset\MasterCategoryController@index');
        Route::get('add', 'Asset\MasterCategoryController@add');
        Route::get('edit/{id}', 'Asset\MasterCategoryController@edit');
        Route::post('save', 'Asset\MasterCategoryController@save');
        Route::post('delete', 'Asset\MasterCategoryController@delete');
        Route::get('get-json-flexfield', 'Asset\MasterCategoryController@getJsonFlexfield');
        Route::post('post-opr-flexfield', 'Asset\MasterCategoryController@postOprFlexfield');
    });
});

Route::group(['prefix' => 'setting', 'middleware' => 'customRedirectIfNotAuthenticated'], function() {
    Route::group(['prefix' => 'company'], function() {
        Route::any('/', 'Setting\CompanyController@index');
        Route::post('save', 'Setting\CompanyController@save');
        Route::get('get-json-province', 'Setting\CompanyController@getJsonProvince');
        Route::get('get-json-city', 'Setting\CompanyController@getJsonCity');
    });
    Route::group(['prefix' => 'user'], function() {
        Route::any('/', 'Setting\UserController@index');
        Route::get('add', 'Setting\UserController@add');
        Route::get('edit/{id}', 'Setting\UserController@edit');
        Route::post('save', 'Setting\UserController@save');
    });
});

