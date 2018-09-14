<?php
return [
    'name' => 'Roles',
    'description' => 'Roles module',
    'status' => true,
    'autoload' => [
        'helper.php'
    ],
    'middleware' => [
        'Roles' => 'Roles'
    ]
];