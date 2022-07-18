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

    /**
     * 关联相同用户的访客记录
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function someUserLogs()
    {
        return $this->hasMany(VisitorLog::class, 'user_id', 'user_id');
    }
}
