<?php

namespace App\Models\Common;

use App\Models\Model;
use Illuminate\Support\Facades\Auth;

class Thumb extends Model
{
    /**
     * Related EntityModel.
     */
    public function entity()
    {
        return $this->morphTo('entity', 'entity_class', 'entity_id')->withTrashed();
        // return $this->belongsTo($this->entity_class, 'entity_id')->withTrashed();
    }

    /**
     * Delete thumb Handler.
     */
    public static function deleteThumbHandler($entity, $type, $user)
    {
        $count = Thumb::where([
            'user_id'       =>  $user->id,
            'entity_class'  =>  get_class($entity),
            'entity_id'     =>  $entity->id,
            'type'          =>  $type,
        ])->delete();

        if ($count) {
            $entity->decrement($type.'_num', $count);
        }

        return $count;
    }

    /**
     * Create thumb handler.
     */
    public static function createThumbHandler($entity, $type)
    {
        $user = Auth::guard('sanctum')->user();

        $thumb = Thumb::firstOrCreate([
            'user_id'       =>  $user->id,
            'entity_class'  =>  get_class($entity),
            'entity_id'     =>  $entity->id,
            'type'          =>  $type,
        ]);

        // 自增 thumb_num
        if ($thumb->wasRecentlyCreated) {
            $thumb->entity->increment($type.'_num');
        }

        // 删除相关的 Thumb
        $reverseType = null;
        if ($type === 'thumb_up') {
            $reverseType = 'thumb_down';
        }
        if ($type === 'thumb_down') {
            $reverseType = 'thumb_up';
        }
        if ($reverseType && $count = Thumb::where([
            'entity_class'  =>  get_class($entity),
            'entity_id'     =>  $entity->id,
            'type'          =>  $reverseType,
        ])->delete()) {
            $thumb->entity->decrement(($reverseType.'_num'), $count);
        }

        return $thumb;
    }
}
