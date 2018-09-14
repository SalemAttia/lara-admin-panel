<?php

    Route::group(['middleware' => ['AdminAuth', 'Roles'], 'prefix' => 'dashboard' , 'as' => 'admin.'], function () {
        Route::resource('Log','LogController');
    });
