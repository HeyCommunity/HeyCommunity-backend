<?php

namespace App\Models;

use App\Models\Common\Thumb;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Model extends EloquentModel
{
    use SoftDeletes;

    // guarded
    protected $guarded = [];

    /**
     * Relation User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation User
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Sort Order
     */
    public function scopeSortOrder($query)
    {
        return $query->orderBy('sort', 'asc')->oldest();
    }

    /**
     * Mine Scope
     */
    public function scopeMine($query)
    {
        return $query->where(['user_id' => Auth::id()]);
    }

    /**
     * CreatedAt In Today Scope
     */
    public function scopeCreatedAtInToday($query)
    {
        return $query->whereDate('created_at', '>=', Carbon::today()->startOfDay())
            ->whereDate('created_at', '<=', Carbon::today()->endOfDay());
    }

    /**
     * Get has thumb up
     */
    public function getHasThumbUpAttribute()
    {
        if (Auth::check()) {
            return Thumb::where([
                'user_id'       =>  Auth::id(),
                'entity_type'   =>  get_class($this),
                'entity_id'     =>  $this->id,
                'type'          =>  'thumb_up',
            ])->exists() ? 1 : 0;
        }

        return 0;
    }
}
