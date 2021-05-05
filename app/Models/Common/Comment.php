<?php

namespace App\Models\Common;

use App\Models\Model;

class Comment extends Model
{
    /**
     * Related EntityModel
     */
    public function entity()
    {
        return $this->belongsTo($this->entity_type, 'entity_id')->withTrashed();
    }
}
