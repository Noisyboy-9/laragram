<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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


    /**
     * A user may be followed by many users
     * @return BelongsToMany
     *
     */
    public function followers()
    {
        return $this->belongsToMany(User::class , 'followings', 'follower' , 'following');
    }

    /**
     * A user can follow many users
     *
     * @param User $user
     */
    public function follow(User $user)
    {
        $this->followers()->attach($user);
    }


    /**
     * Check to see if user is followed
     *
     * @param User $user
     * @return mixed
     */
    public function isFollowing(User $user)
    {
        return $this->followers->contains($user);
    }
}
