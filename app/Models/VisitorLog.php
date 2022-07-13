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
        'visitor_ip_info'       =>  'array',
        'visitor_agent_info'    =>  'array',
        'request_data'          =>  'array',
    ];
}
