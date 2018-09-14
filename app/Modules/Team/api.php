<?php
  Route::group(['prefix' => 'v1'], function () {
      Route::get('teams/{limit}/{offset}', 'TeamApiController@index');
      Route::get('teams/{id}', 'TeamApiController@show');
      Route::post('teams', 'TeamApiController@store');
      Route::put('teams/{id}', 'TeamApiController@update');
      Route::delete('teams/{id}', 'TeamApiController@delete');

  });

    Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {

    });
