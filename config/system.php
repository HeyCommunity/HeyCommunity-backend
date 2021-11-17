<?php

return [
    'cdn'   =>  [
        'enable'    =>  env('CDN_ENABLE', false),
        'domain'    =>  env('CDN_DOMAIN', 'https://your-cdn-domain.com')
    ],

    'wxapp'     =>  [
        'subscribe_message' =>  [
            'enable'                =>  env('WXAPP_SUBSCRIBE_MESSAGE_ENABLE', false),
            'thumb_up_temp_id'      =>  env('WXAPP_SUBSCRIBE_MESSAGE_THUMB_UP_TEMP_ID'),
            'comment_temp_id'       =>  env('WXAPP_SUBSCRIBE_MESSAGE_COMMENT_TEMP_ID'),
            'reply_temp_id'         =>  env('WXAPP_SUBSCRIBE_MESSAGE_REPLY_TEMP_ID'),
        ]
    ]
];
