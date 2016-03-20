<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::controllers([

    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',

]);

Route::get('/', ['as' => 'home', 'uses' => 'StoreController@index']);
Route::get('/home', ['as' => 'home', 'uses' => 'StoreController@index']);

Route::get('/teste', ['as' => 'teste', 'uses' => 'CheckoutController@test']);

Route::group(['prefix'=>'store'], function() {

    Route::get('category/{id}', ['as' => 'store.category', 'uses' => 'StoreController@category']);
    Route::get('tag/{id}', ['as' => 'store.tag', 'uses' => 'StoreController@tag']);
    Route::get('product/{id}', ['as' => 'store.product', 'uses' => 'StoreController@product']);
    Route::get('cart', ['as' => 'store.cart', 'uses' => 'CartController@index']);
    Route::get('cart/add/{id}', ['as' => 'store.cart.add', 'uses' => 'CartController@add']);
    Route::get('cart/destroy/{id}', ['as' => 'store.cart.destroy', 'uses' => 'CartController@destroy']);
    Route::get('cart/update_qty/{id}/{qty}', ['as' => 'store.cart.update_qty', 'uses' => 'CartController@update_qty']);
});

Route::group(['prefix'=>'checkout', 'middleware'=>'auth'], function() {

    Route::get('place_order', ['as' => 'checkout.place.order', 'uses' => 'CheckoutController@place_order']);
});

Route::group(['prefix'=>'pagseguro'], function() {
    Route::get('retorno', ['as' => 'store.checkout.retorno', 'uses' => 'CheckoutController@retorno']);
});

Route::group(['prefix'=>'account', 'middleware'=>'auth'], function() {

    Route::get('orders', ['as' => 'account.orders', 'uses' => 'AccountController@orders']);
    Route::get('edit_status_order/{id}', ['as' => 'account.edit_status_order', 'uses' => 'AccountController@edit_status_order']);
    Route::put('save_status_order', ['as' => 'account.save_status_order', 'uses' => 'AccountController@save_status_order']);

});


Route::group(['prefix'=>'admin','middleware'=>'auth.admin', 'where'=>['id'=>'[0-9]+']], function() {

    Route::get('/', ['as' => 'admin', 'uses' => 'WelcomeController@index']);
    Route::get('orders', ['as' => 'admin.orders', 'uses' => 'AdminController@order_list']);

    Route::group(['prefix'=>'categories'], function() {

        Route::get('', ['as' => 'categories', 'uses' => 'CategoriesController@index']);
        Route::post('', ['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
        Route::get('create', ['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
        Route::get('{id}/delete', ['as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy']);
        Route::get('{id}/edit', ['as' => 'categories.edit', 'uses' => 'CategoriesController@edit']);
        Route::put('{id}/update', ['as' => 'categories.update', 'uses' => 'CategoriesController@update']);

    });

    Route::group(['prefix'=>'products'], function() {

        Route::get('', ['as'=>'products', 'uses'=>'ProductsController@index']);
        Route::post('', ['as'=>'products.store', 'uses'=>'ProductsController@store']);
        Route::get('create', ['as'=>'products.create', 'uses'=>'ProductsController@create']);
        Route::get('{id}/delete', ['as'=>'products.destroy', 'uses'=>'ProductsController@destroy']);
        Route::get('{id}/edit', ['as'=>'products.edit', 'uses'=>'ProductsController@edit']);
        Route::put('{id}/update', ['as'=>'products.update', 'uses'=>'ProductsController@update']);


        Route::group(['prefix'=>'images'], function() {

            Route::get('{id}', ['as'=>'products.images', 'uses'=>'ProductsController@images_index']);
            Route::get('{id}/create', ['as'=>'products.images.create', 'uses'=>'ProductsController@images_create']);
            Route::post('{id}/store', ['as'=>'products.images.store', 'uses'=>'ProductsController@images_store']);
            Route::get('{id}/destroy', ['as'=>'products.images.destroy', 'uses'=>'ProductsController@images_destroy']);

        });

    });


});


