<?php

namespace App\Models;

class VisitorLog extends Model
{
    /**
     * casts
     *
     * @var string[]
     */
    protected $casts = [
        'request_get_data'  =>  'array',
        'request_post_data' =>  'array',
        'request_cookies'   =>  'array',
        'request_headers'   =>  'array',
    ];
}
