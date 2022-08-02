<?php

return [
    'route'         => [
        'enabled'    => false,

        'attributes' => [
            'prefix'     => 'dashboard/log-viewer',

            'middleware' => [
                'web',
                \App\Http\Middleware\DashboardAuthenticate::class,
            ],
        ],
    ],
];
