<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FollowSystemTest extends TestCase
{
    use  RefreshDatabase;
    /** @test **/
    public function a_member_can_follow_another_member()
    {
        $this->withoutExceptionHandling();

        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

        $this->post('/members/' . $user2->id);

        $this->assertDatabaseHas('followings', [
            'follower' => $user1->id,
            'following' => $user2->id,
        ]);

        $this->assertTrue($user1->isFollowing($user2));
    }
}
