<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subscribers()
    {
        return $this->hasMany(Subscribe::class, 'subscribe_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscribe::class, 'user_id');
    }

    public function subscribersCount()
    {
        return $this->subscribers()->count();
    }

    public function subscriptionsCount()
    {
        return $this->subscriptions()->count();
    }

    public function isSubscribedTo($userId)
    {
        return Subscribe::isSubscribed($this->id, $userId);
    }
}
