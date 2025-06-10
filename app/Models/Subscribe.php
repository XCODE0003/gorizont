<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['user_id', 'subscribe_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscribedTo()
    {
        return $this->belongsTo(User::class, 'subscribe_id');
    }

    public static function isSubscribed($userId, $subscribeId)
    {
        return self::where('user_id', $userId)->where('subscribe_id', $subscribeId)->exists();
    }
}
