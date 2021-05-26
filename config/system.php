<?php

return [
    'ugc_audit'     =>  env('SYSTEM_UGC_AUDIT', true),

    'wxapp'     =>  [
        'subscribe_message' =>  [
            'post_thumb_up'     =>  env('WXAPP_SUBSCRIBE_MESSAGE_POST_THUMB_UP'),
            'post_comment'      =>  env('WXAPP_SUBSCRIBE_MESSAGE_POST_COMMENT'),

            'enable'                =>  env('WXAPP_SUBSCRIBE_MESSAGE_ENABLE', false),
            'thumb_up_temp_id'      =>  env('WXAPP_SUBSCRIBE_MESSAGE_THUMB_UP_TEMP_ID'),
            'comment_temp_id'       =>  env('WXAPP_SUBSCRIBE_MESSAGE_COMMENT_TEMP_ID'),
            'reply_temp_id'         =>  env('WXAPP_SUBSCRIBE_MESSAGE_REPLY_TEMP_ID'),
        ]
    ]
];
