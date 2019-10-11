<?php

namespace Tests\Unit;

use App\Post;
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
}
