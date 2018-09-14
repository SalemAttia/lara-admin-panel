<?php
return [
    'name' => 'Team',
    'description' => 'Team module',
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