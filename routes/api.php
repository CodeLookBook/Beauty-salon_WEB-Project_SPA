<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


/**
 * Routes available for all web users;
 */
Route::post      ('/admin/signin'                     , 'UserController@signin'           );
Route::get       ('admin/auth/validation'             , 'AuthController@isValid'          );
Route::post      ('order'                             , 'OrderController@create'          );
Route::get       ('services'                          , 'ServiceController@list'          );
Route::get       ('price'                             , 'PriceController@download'        );


/**
 * Routes for Orders management. Only for admins.
 */
Route::group(['middleware'=>['admin']], function (){

    Route::get   ('orders'                            , 'OrderController@list'           );
    Route::get   ('orders/count'                      , 'OrderController@count'          );
    Route::get   ('orders/range/{startDate}/{endDate}', 'OrderController@range'          );
//    Route::post  ('order'                             , 'OrderController@create'         );
    Route::get   ('order/{order}'                     , 'OrderController@read'           );
    Route::patch ('order/{order}'                     , 'OrderController@update'         );
    Route::delete('order/{order}'                     , 'OrderController@delete'         );

    Route::get   ('orders/trashed'                     , 'OrderController@trashedList'   );
    Route::get   ('orders/trashed/count'               , 'OrderController@trashedCount'  );
    Route::get   ('orders/trashed/range/{startDate}/{endDate}' , 'OrderController@trashedRange'  );
    Route::get   ('order/trashed/{trashedOrder}'       , 'OrderController@readTrashed'   );
    Route::patch ('order/trashed/{trashedOrder}'       , 'OrderController@restoreTrashed');
    Route::delete('order/trashed/{trashedOrder}'       , 'OrderController@deleteTrashed' );

});


/**
 * Routes for Services data management. Only for admins.
 */
Route::group(['middleware'=>['admin']], function(){

    Route::get   ('services/count'                       , 'ServiceController@count'         );
    Route::post  ('service'                              , 'ServiceController@create'        );
    Route::get   ('service/{service}'                    , 'ServiceController@read'          );
    Route::patch ('service/{service}'                    , 'ServiceController@update'        );
    Route::delete('service/{service}'                    , 'ServiceController@delete'        );

    Route::get   ('services/trashed/count'               , 'ServiceController@trashedCount'  );
    Route::get   ('services/trashed'                     , 'ServiceController@trashedList'   ); //+
    Route::get   ('service/trashed/{trashedService}'     , 'ServiceController@readTrashed'   );
    Route::patch ('service/trashed/{trashedService}'     , 'ServiceController@restoreTrashed');
    Route::delete('service/trashed/{trashedService}'     , 'ServiceController@deleteTrashed' );

});

/**
 * Router for Customers data management. Only for admins.
 */
Route::group(['middleware'=>['admin']], function (){

    Route::get   ('customers/count'                      , 'CustomerController@count'         );
    Route::get   ('customers/range/{skip}/{take}'        , 'CustomerController@range'         );
    Route::post  ('customer'                             , 'CustomerController@create'        );
    Route::get   ('customer/{customer}'                  , 'CustomerController@read'          );
    Route::patch ('customer/{customer}'                  , 'CustomerController@update'        );
    Route::delete('customer/{customer}'                  , 'CustomerController@delete'        );

    Route::get   ('customers/trashed/count'              , 'CustomerController@trashedCount'  );
    Route::get   ('customers/trashed/range/{skip}/{take}', 'CustomerController@trashedRange'  );
    Route::get   ('customer/trashed/{trashedCustomer}'   , 'CustomerController@readTrashed'   );
    Route::patch ('customer/trashed/{trashedCustomer}'   , 'CustomerController@restoreTrashed');
    Route::delete('customer/trashed/{trashedCustomer}'   , 'CustomerController@deleteTrashed' );

});

Route::group(['middleware'=>['admin']], function (){

    Route::get   ('order_states'                            , 'OrderStateController@list'          );
    Route::post  ('order_state'                             , 'OrderStateController@create'        );
    Route::get   ('order_state/{orderState}'                , 'OrderStateController@read'          );
    Route::patch ('order_state/{orderState}'                , 'OrderStateController@update'        );
    Route::delete('order_state/{orderState}'                , 'OrderStateController@delete'        );

    Route::get   ('order_states/trashed'                    , 'OrderStateController@list'          );
    Route::get   ('order_state/trashed/{trashedOrderState}' , 'OrderStateController@readTrashed'   );
    Route::patch ('order_state/trashed/{trashedOrderState}' , 'OrderStateController@restoreTrashed');
    Route::delete('order_state/trashed/{trashedOrderState}' , 'OrderStateController@deleteTrashed' );

});

Route::group(['middleware'=>['admin']], function (){
    Route::post  ('price'                                   , 'PriceController@save'               );
});

