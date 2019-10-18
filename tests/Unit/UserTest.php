<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_may_has_many_posts()
    {
        $user = $this->signIn();
        $post = factory(Post::class)->create();

        $this->assertInstanceOf(Collection::class , $user->posts);
    }

    /** @test **/
    public function it_can_follow_another_user()
    {
        $this->withoutExceptionHandling();

        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

        $user1->follow($user2);

        $this->assertTrue($user1->followers->contains($user2));
    }

    /** @test **/
    public function it_may_have_may_followers()
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
}
