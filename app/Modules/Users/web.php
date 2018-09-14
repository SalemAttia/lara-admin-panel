<?php

Route::group(['middleware' => ['AdminAuth', 'Roles','Log'], 'prefix' => 'dashboard' , 'as' => 'admin.'], function () {
    Route::resource('User','UsersController');
    Route::get('ExportExcel/User','ExportDataExcel@export');
    Route::post('readExcel/User','ExportDataExcel@readExcel');
    Route::get('xlxTemplate/User','ExportDataExcel@ExportExcelTemplete');
});
