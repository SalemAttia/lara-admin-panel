<?php

Route::group(['middleware' => ['AdminAuth', 'ProtectAdmin', 'Roles','Log'], 'prefix' => 'dashboard' , 'as' => 'admin.'], function () {
    Route::resource('admins','AdminsController');
    Route::get('ExportExcel/admins','ExportDataExcel@export');
    Route::post('readExcel/admins','ExportDataExcel@readExcel');
});