<?php

namespace Modules\Activity\Entities;

use App\Models\Model;
use App\Models\User;
use Modules\Activity\Database\factories\ActivityFactory;

class Activity extends Model
{
    /**
     * casts
     */
    protected $casts = [
        'started_at'    =>  'datetime',
    ];

    /**
     * newFactory
     */
    protected static function newFactory()
    {
        return ActivityFactory::new();
    }

    /**
     * 关联 ActivityMember
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'activity_members')->where('activity_members.status', 1);
    }

    /**
     * Get cover attribute
     */
    public function getCoverAttribute($value)
    {
        return getAssetFullPath($value);
    }
}
