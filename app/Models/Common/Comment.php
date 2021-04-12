<?php

namespace App\Models\Common;

use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    /**
     * Related User
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
