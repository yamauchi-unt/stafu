<?php

return [
    // 一般公開用
    'public' => [
        'user_id' => env('BASIC_AUTH_USER_ID_PUBLIC'),
        'password' => env('BASIC_AUTH_PASSWORD_PUBLIC'),
    ],
    // 管理画面用
    'admin' => [
        'user_id' => env('BASIC_AUTH_USER_ID_ADMIN'),
        'password' => env('BASIC_AUTH_PASSWORD_ADMIN'),
    ],
    // API用
    'api' => [
        'user_id' => env('BASIC_AUTH_USER_ID_API'),
        'password' => env('BASIC_AUTH_PASSWORD_API'),
    ],
];
