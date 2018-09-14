<?php
Route::group(['prefix' => 'v1'], function () {
    Route::post('login', 'LoginAndRegisterApi@login');
    // update profile
    Route::post('updateProfile', 'UpdateUserData@updateProfile');
    //forgetpassword mail
    Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
    //reset password
    Route::post('password/reset', 'Auth\ResetmyPasswordController@reset');
    // websearch
    Route::get('User/search', 'UserApiController@search');


    Route::get('users/{limit}/{offset}', 'UserApiController@index');
    Route::get('users/{id}', 'UserApiController@show');
    Route::post('users', 'UserApiController@store');
    Route::post('user/teams/{user_id}', 'UserApiController@storeUserTeam');
    Route::post('user/teamOwner/{user_id}', 'UserApiController@SetTeamOwner');
    Route::put('users/{id}', 'UserApiController@update');
    Route::delete('users/{id}', 'UserApiController@delete');


});

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {


});



