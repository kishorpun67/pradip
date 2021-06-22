<?php

use App\Admin\Category;
use Illuminate\Http\Request;
use App\User;
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
Route::group(['middleware' => ['auth:sanctum']], function(){

    // route for update customer setting
    Route::get('settings', 'API\UserController@settings');
    Route::post('update-current-password', 'API\UserController@updateCurrentPassword');
    Route::post('update-details', 'API\UserController@updateDetails');

    // Route for section
    Route::get('section', 'API\SectionController@section');

    // Route for barnd
    Route::get('brands', 'API\BrandController@brands');

    // Route for main category
    Route::get('mainCategory', 'API\CategoryController@mainCategory');

    // Route for Category
    Route::get('categories', 'API\CategoryController@categories');

    // Route for show products
    Route::get('products/{url?}', 'API\ProtuctsController@products');

    // route for product detalis
    Route::get('product/{id?}', 'API\ProtuctsController@product');




    //show product through url
    // Route::get('')

    Route::get('test', function(){
        echo "test"; die;
    });


  });


  Route::post('login', 'API\UserController@login')->name('login');
  Route::post('register', 'API\UserController@register');
  Route::post('forget-passoword', 'API\UserController@forgetPassword');
  Route::post('confirm/{email?}', 'API\UserController@confirm');

