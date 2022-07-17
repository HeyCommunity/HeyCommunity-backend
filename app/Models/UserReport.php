<?php

namespace App\Models;

class UserReport extends Model
{
    /**
     * Related Entity.
     */
    public function entity()
    {
        return $this->belongsTo($this->entity_class)->withTrashed();
    }

    /**
     * Get entity_content attr.
     */
    public function getEntityContentAttribute()
    {
        return $this->entity->content;
    }
}
