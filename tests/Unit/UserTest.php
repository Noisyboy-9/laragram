<?php

namespace Tests\Unit;

use App\Laragram\followingSystem\FollowingStatusManager;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_may_have_many_posts()
    {
        $user = $this->signIn();
        $post = factory(Post::class)->create();

        $this->assertInstanceOf(Collection::class , $user->posts);
    }

    /** @test **/
    public function it_may_follow_another_user()
    {
        $this->withoutExceptionHandling();

        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

        $user1->follow($user2);

        $this->assertTrue($user1->followings->contains($user2));
    }

    /** @test **/
    public function it_may_have_many_followers()
    {
        $this->withoutExceptionHandling();
//        given : we have two users -> user1 & user2 that user1 has followed user2
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

//        when : we want to get followers of user2
        $user1->follow($user2);
//        then : we must get an collection
        $this->assertInstanceOf(Collection::class, $user2->followers);
    }

    /** @test **/
    public function it_may_have_many_followings()
    {
        $this->withoutExceptionHandling();

        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();
        $user1->follow($user2);
        $user2->accept($user1);

        $this->assertInstanceOf(Collection::class, $user1->followings);
    }
    /** @test **/
    public function it_can_check_if_is_requeted_to_following_another_user()
    {
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

        $user1->follow($user2);

        $this->assertTrue($user1->hasRequestedFollowing($user2));
    }

    /** @test **/
    public function it_can_decline_incoming_follow_request()
    {
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();
        $user2->follow($user1);

        $user1->decline($user2);

        $this->assertDatabaseHas('followings' , [
            'follower' => $user2->id,
            'following' => $user1->id,
            'status' => FollowingStatusManager::STATUS_DECLINED
        ]);

        $this->assertDatabaseMissing('followings', [
            'follower' => $user2->id,
            'following' => $user1->id,
            'status' => FollowingStatusManager::STATUS_SUSPENDED
        ]);
    }

    /** @test **/
    public function it_can_accept_incoming_follow_requst()
    {
        $this->withoutExceptionHandling();

        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();
        $user1->follow($user2);

        $user2->accept($user1);

        $this->assertTrue($user1->isFollowing($user2));
    }

    /**  @test **/
    public function it_can_check_if_it_is_following_another_member()
    {
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();
        $user2->follow($user1);
        $user1->accept($user2);

        $this->assertTrue($user2->isFollowing($user1));
    }
}
