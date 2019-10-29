<?php

namespace App;

use App\Laragram\followingSystem\Follower;
use App\Laragram\followingSystem\Following;
use App\Laragram\followingSystem\FollowingStatusManager;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Follower, Following;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (User $user) {
            $user->username = $user->generateUsername();
        });
    }

    /**
     * generate a hashed username
     *
     * @param User $user
     * @return string
     */
    function generateUsername()
    {
        $username = bcrypt($this->email);

        $username = preg_replace('/[.\/]/', str_shuffle($this->name), $username) . time();

        return $username;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A user may have many posts
     *
     * @return HasMany
     *
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'owner_id');
    }
}
