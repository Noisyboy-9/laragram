<?php

namespace Tests\Feature;

use App\Laragram\followingSystem\FollowingStatusManager;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowSystemTest extends TestCase
{
    use  RefreshDatabase;

    /** @test **/
    public function a_member_can_follow_another_member()
    {
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

        $this->post('/members/' . $user2->id);

        $this->assertDatabaseHas('followings', [
            'follower' => $user1->id,
            'following' => $user2->id,
        ]);

        $this->assertTrue($user1->hasRequestedFollowing($user2));
    }

    /** @test **/
    public function after_sending_a_follow_request_the_request_should_get_accepted_to_establish()
    {
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

        $user1->follow($user2);

        $this->assertDatabaseHas('followings' , [
            'follower' => $user1->id,
            'following' => $user2->id,
            'status' => FollowingStatusManager::STATUS_SUSPENDED
        ]);
    }

    /** @test **/
    public function the_follower_may_decline_an_follow_request()
    {
        $this->withoutExceptionHandling();

        $user1 = factory(User::class)->create();
        $user2 = $this->signIn();
        $user1->follow($user2);

        $this->assertTrue($user1->hasRequestedFollowing($user2));

        $this->post('/followers/' . $user1->id . '/decline');

        $this->assertTrue($user2->hasDeclined($user1));
        $this->assertFalse($user1->hasRequestedFollowing($user2));
    }

    /** @test **/
    public function a_user_accept_another_user_request()
    {
        $this->withoutExceptionHandling();
//        given : we have two users -> *user1* user2 that user2 has followed user1
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();
        $user2->follow($user1);

//        when : user1 request to accept endpoint
        $this->post('/followers/' . $user2->id . '/accept');

        $this->assertTrue($user2->isFollowing($user1));
        $this->assertDatabaseHas('followings' , [
            'follower' => $user2->id,
            'following' => $user1->id,
            'status' => FollowingStatusManager::STATUS_ACCEPTED
        ]);
//        then : the request will be updated
    }
}
