<?php


namespace App\Laragram\followingSystem;


use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Following
{
    /**
     * A user may accept given user follow request
     *
     * @param User $user
     */
    public function accept(User $user)
    {
        $this->followers()->sync(
            [
                $user->id => [
                    'status' => FollowingStatusManager::STATUS_ACCEPTED,
                ]
            ]);
    }

    /**
     * A user may decline given user follow request
     *
     * @param User $user
     */
    public function decline(User $user)
    {
        $this->followers()->sync([
            $user->id => [
                'status' => FollowingStatusManager::STATUS_DECLINED
            ]
        ]);
    }

    /**
     * A user may have many followings
     *
     * @return BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followings', 'follower', 'following');
    }

    /**
     * Check to see if given user's request is declined
     *
     * @param User $user
     * @return bool
     */
    public function hasDeclined(User $user)
    {
        return $this->followers()
            ->where('follower', $user->id)
            ->where('status', FollowingStatusManager::STATUS_DECLINED)
            ->exists();
    }
}
