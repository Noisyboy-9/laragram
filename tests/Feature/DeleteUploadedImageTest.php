<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUploadedImageTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function guests_can_not_delete_post()
    {
        $post = factory(Post::class)->create();
        $this->delete('/posts/' . $post->id)->assertRedirect('login');
    }

    /** @test **/
    public function a_user_can_delete_his_post()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $post = factory(Post::class)->create(['owner_id'=> $user->id]);

        $this->assertDatabaseHas('posts', ['path' => $post->path, 'id' => $post->id]);
        $this->delete('/posts/' . $post->id)->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['path' => $post->path, 'id' => $post->id]);
    }

    /** @test **/
    public function a_user_can_only_delete_his_own_post()
    {
        $user1 = $this->signIn();
        $user2 = factory(User::class)->create();

        $post = factory(Post::class) ->create(['owner_id' => $user2->id]);

        $this->delete('/posts/' . $post->id)->assertStatus(403);
    }
}
