<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUploadedImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_user_can_delete_his_own_post()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $post = factory(Post::class)->create(['owner_id'=> $user->id]);

        $this->assertDatabaseHas('posts', ['path' => $post->path, 'id' => $post->id]);
        $this->delete('/posts/' . $post->id)->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['path' => $post->path, 'id' => $post->id]);
    }
}
