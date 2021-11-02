<?php

return [
    /*
    |--------------------------------------------------------------------------
    | EXTENSIONS -> Ad
    |--------------------------------------------------------------------------
    |
    | The migrations folder in database directory
    */
    'migrations_path' => database_path('extensions/livenews'),
    
    'models' => [
        'livenews'     =>  \Guysolamour\Administrable\Extensions\Livenews\Models\Livenews::class,
    ],
    'forms' => [
        'back' => [
            'livenews' => \Guysolamour\Administrable\Extensions\Livenews\Forms\Back\LivenewsForm::class,
        ],
    ],
    'controllers' => [
        'back' => [
            'livenews' => \Guysolamour\Administrable\Extensions\Livenews\Http\Controllers\Back\LivenewsController::class,
        ],
    ],
];
