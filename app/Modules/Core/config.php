<?php
return [
    'name' => 'Core',
    'description' => 'Core Modules',
    'status' => true,
    'autoload' => [
        'Helpers/helper.php',  'Helpers/MassageHelper.php', 'Helpers/ResponseHelper.php','Helpers/directive.php', 'Helpers/DashboardMenu.php'
    ],
    'middleware' => [

    ]
];
