<?php

Route::get('/', '\App\Modules\Dashboard\Controllers\DashboardController@index')->name('dashboard');
Route::get('/home', 'HomeController@home')->middleware('auth');

Route::get('/register',function (){
    return redirect('/');
})->name('register');
Route::get('/login',function (){
    return redirect('/');
})->name('login');
//Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
//Auth::routes();
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');



Route::group(['prefix' => 'dashboard' , 'as' => 'admin.'], function () {
    Route::any('{notFound}', function($notFound){
        return "Not found page $notFound in Dashboard";
    });
});

Route::any('{notFound}', function($notFound){
    return "Not found $notFound";
});