<?php

Route::group(['prefix' => 'dashboard' , 'as' => 'admin.'], function () {
    Route::get('/login','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login');
    Route::post('/logout','Auth\LoginController@logout');
//    Route::get('/resetPassword','DashboardController@resetPassword');
    Route::get('/','DashboardController@index')->name('dashboard');
    Route::get('/profile','Auth\ProfileController@showProfile')->name('profile');
    Route::post('/profile','Auth\ProfileController@profile');
    Route::any('/not-have-access', function (){
        return view('Dashboard::notAccess');
    });
});
