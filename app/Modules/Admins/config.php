<?php
return [
    'name' => 'Admins',
    'description' => 'Admins',
    'status' => true,
    'autoload' => [
        'helper.php'
    ],
    'middleware' => [
        'AdminAuth' => 'AdminAuth',
        'ProtectAdmin' => 'ProtectAdmin',
        'Log' => 'Log'
    ],
    'menu' => 'Views/menu.blade.php'
];