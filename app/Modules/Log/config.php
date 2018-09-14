<?php
return [
    'name' => 'Log',
    'description' => 'Log module',
    'status' => true,
    'autoload' => [
        'helper.php'
    ],
    'middleware' => [
        'AdminAuth' => 'AdminAuth',
        'ProtectAdmin' => 'ProtectAdmin'
    ],
    'menu' => 'Views/menu.blade.php'
];