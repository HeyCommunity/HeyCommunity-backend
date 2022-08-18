<?php

namespace App\Models;

class Feed extends Model
{
    /**
     * 关联 EntityModel
     */
    public function entity()
    {
        return $this->morphTo('entity', 'entity_class', 'entity_id')->withTrashed();
    }
}
