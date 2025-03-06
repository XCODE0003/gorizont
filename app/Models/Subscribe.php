<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['user_id', 'subscribe_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscribe()
    {
        return $this->belongsTo(User::class);
    }

    public function isSubscribed(User $user)
    {
        return $this->where('user_id', $user->id)->where('subscribe_id', $this->id)->exists();
    }
}
