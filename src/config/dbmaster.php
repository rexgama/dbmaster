<?php

return [
    'route_prefix' => 'dbmaster',
    'middleware' => ['web', 'auth'],
    
    'auth' => [
        'guard' => 'web',
    ],

    'tables' => [
        'exclude' => [
            'migrations',
            'password_resets',
            'personal_access_tokens',
        ],
    ],

    'api' => [
        'prefix' => 'api/v1',
        'middleware' => ['api'],
    ],
];