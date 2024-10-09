<?php

return [
    // 一般公開用
    'public' => explode(',', env('IP_WHITELIST_PUBLIC')),

    // 管理画面用
    'admin' => explode(',', env('IP_WHITELIST_ADMIN')),
];
