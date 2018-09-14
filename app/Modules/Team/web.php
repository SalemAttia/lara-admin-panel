<?php

    Route::group(['middleware' => ['AdminAuth', 'Roles','Log'], 'prefix' => 'dashboard' , 'as' => 'admin.'], function () {
        Route::resource('Team','TeamController');
    });

 Route::group(['middleware' => ['AdminAuth', 'Roles'], 'prefix' => 'dashboard' , 'as' => 'admin.'], function () {
       Route::get('ExportExcel/Team','ExportDataExcel@export');
       Route::post('readExcel/Team','ExportDataExcel@readExcel');
        Route::get('xlxTemplate/Team','ExportDataExcel@ExportExcelTemplete');
    });
