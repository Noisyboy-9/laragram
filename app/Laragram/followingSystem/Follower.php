<?php


namespace App\Laragram\followingSystem;


use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Follower
{

    /**
     * A user can follow many users
     *
     * @param User $user
     */
    public function follow(User $user)
    {
        $this->followings()->attach($user, ['status' => FollowingStatusManager::STATUS_SUSPENDED]);
    }

    /**
     * Check to see if user is followed
     *
     * @param User $user
     * @return mixed
     */
    public function hasRequestedFollowing(User $user)
    {
        return $this->followings()
            ->where('following', $user->id)
            ->where('status', FollowingStatusManager::STATUS_SUSPENDED)
            ->exists();
    }

    /**
     * A user may be followed by many users
     * @return BelongsToMany
     *
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followings', 'following', 'follower');
    }


    /**
     * A user can check that is following given user
     *
     * @param User $user
     * @return mixed
     */
    public function isFollowing(User $user)
    {
        return $this->followings()
            ->where('following' , $user->id)
            ->where('status' , FollowingStatusManager::STATUS_ACCEPTED)
            ->exists();
    }
}
