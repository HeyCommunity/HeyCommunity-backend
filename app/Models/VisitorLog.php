<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * @method static activeUserOfDate(\Illuminate\Support\Carbon $now)
 */
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
     */
    public function sameUserLogs()
    {
        return $this->hasMany(VisitorLog::class, 'user_id', 'user_id');
    }

    public function scopeActiveUserOfDate($query, $date)
    {
        return $query
            ->groupBy('user_id')
            ->whereNotNull('user_id')
            ->whereDate('created_at', $date)
            ->select([
                'user_id',
                DB::raw('COUNT(*) as total_num'),
                DB::raw('MIN(created_at) as start_time'),
                DB::raw('MAX(created_at) as end_time'),
                DB::raw('GROUP_CONCAT(DISTINCT visitor_ip_locale) as locales'),
                DB::raw('GROUP_CONCAT(DISTINCT visitor_agent_device) as devices'),
            ])
            ->orderBy('start_time')
            ->with(['sameUserLogs' => function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            }]);
    }
}
