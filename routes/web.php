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
//    return view('dashboard.dashboard');
});
Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::post('item/getPrice','ItemController@getPrice');
    Route::post('ingredient/getPrice','IngredientController@getPrice');
    Route::post('ingredient/getPriceByUnit','IngredientController@getPriceByUnit');

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/item','ItemController@index');
    Route::get('/item/create','ItemController@create');

    Route::post('/item/store','ItemController@store');
    Route::get('/item/directadd','ItemController@directadd');
    Route::post('/item/directadditem','ItemController@directadditem');
    Route::get('/item/detail/{id}','ItemController@detail');
    Route::get('/item/edit/{user_id}','ItemController@edit');
    Route::get('/item/delete/{id}','ItemController@destroy');
    Route::post('/item/update/','ItemController@update');
    Route::any('/order','OrderController@index');
    Route::any('/order/create','OrderController@create');
    Route::any('/order/delete/{order_id}','OrderController@orderdelete');
    Route::any('/order/search','OrderController@index');

    Route::any('/bazaar/list','HomeController@bazaarList');
    Route::any('/bazaar/listitem','HomeController@listitem');
    Route::post('/listitem/date','HomeController@listitem');

    Route::any('mess/generate/bill','HomeController@generateBill');
    Route::any('/usercost','HomeController@generateBill');

    // Route::any('/bazaar/mealtime','HomeController@mealtime');
    Route::any('/miltime/genarate','HomeController@miltimegenarate');
    Route::any('mess/bill','HomeController@messBill');

    Route::any('/bazaar/messbillinsert','HomeController@messBill');
    Route::any('mess/billlist','HomeController@messBillList');

    Route::any('/messbill_list/delete/{id}','HomeController@delete');
    Route::any('/messbill_list/edit/{id}','HomeController@edit');
    Route::any('/messbillupdate','HomeController@messbillupdate');


    Route::any('ingredient','IngredientController@index');
    Route::any('ingredient/create','IngredientController@create');
    Route::get('ingredient/edit/{id}','IngredientController@edit');
    Route::get('ingredient/delete/{id}','IngredientController@delete');



    Route::get('customers','CustomerController@index');
    Route::get('customer/create','CustomerController@create');
    Route::get('customer/edit/{id}','CustomerController@edit');
    Route::post('customer/store','CustomerController@store');
    Route::get('customer/delete/{id}','CustomerController@destroy');

    Route::post('/item/list/api','ItemController@itemApi');


});
