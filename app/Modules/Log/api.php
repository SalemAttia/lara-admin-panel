<?php
  Route::group(['prefix' => 'v1'], function () {
    Route::post('getAll', 'LogApiController@ReturnAll');
    Route::post('getById', 'LogApiController@ReturnById');
    Route::post('createItem', 'LogApiController@CreateItem');
    Route::post('updateItem', 'LogApiController@UpdateItem');
    Route::delete('Logs/item/{item_id?}', 'LogApiController@deleteItem');
    });

    Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {

    });
