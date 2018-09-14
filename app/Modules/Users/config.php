<?php
return [
    'name' => 'Users',
    'description' => 'Users module',
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