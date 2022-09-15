<?php

namespace Modules\Activity\Entities;

use App\Models\Model;
use Modules\Activity\Database\factories\ActivityMemberFactory;

class ActivityMember extends Model
{

    /**
     * newFactory
     */
    protected static function newFactory()
    {
        return ActivityMemberFactory::new();
    }
}
