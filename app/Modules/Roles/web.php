<?php
Route::group(['middleware' => ['AdminAuth', 'Roles','Log'], 'prefix' => 'dashboard' , 'as' => 'admin.'], function () {
    Route::resource('roles','RolesController');
    Route::resource('permissions','PermissionsController');
});
