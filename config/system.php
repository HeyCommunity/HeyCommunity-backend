<?php

return [
    'ugc_audit'     =>  env('SYSTEM_UGC_AUDIT', true),

    'wxapp'     =>  [
        'subscribe_message' =>  [
            'post_thumb_up'     =>  env('WXAPP_SUBSCRIBE_MESSAGE_POST_THUMB_UP'),
            'post_comment'      =>  env('WXAPP_SUBSCRIBE_MESSAGE_POST_COMMENT'),
        ]
    ]
];
