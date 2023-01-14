<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Friends\FriendStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** Relationships */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /** User's friends */
    public function friends()
    {
        return $this->belongsToMany(__CLASS__, 'friends', 'user_id', 'friend_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function friendsTo()
    {
        return $this->belongsToMany(__CLASS__, 'friends', 'friend_id', 'user_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function friendsPending()
    {
        return $this->friends()->wherePivot('status', FriendStatusEnum::PENDING->value);
    }

    public function friendsPendingTo()
    {
        return $this->friendsTo()->wherePivot('status', FriendStatusEnum::PENDING->value);
    }

    public function friendsAccepted()
    {
        return $this->friends()->wherePivot('status', FriendStatusEnum::ACCEPTED->value);
    }

    public function FriendsAcceptedTo()
    {
        return $this->friendsTo()->wherePivot('status', FriendStatusEnum::ACCEPTED->value);
    }

    public function getAvatarAttribute()
    {
        return generate_avatar($this);
    }
}
