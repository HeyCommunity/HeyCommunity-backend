<?php

return [
    'dashboard'     =>  [
        'admin_ids'         =>  explode(',', env('HEYCOMMUNITY_DASHBOARD_ADMIN_IDS')),
    ],

    'heartbeat'     =>  [
        'enabled'           =>  env('HEYCOMMUNITY_HEARTBEAT_ENABLED', true),
    ]
];
