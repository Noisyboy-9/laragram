<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function guests_can_not_make_a_new_post()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image
        ])->assertRedirect('login');
    }

    /** @test **/
    public function an_authenticated_user_can_upload_image_and_make_new_post_and_path_and_owner_id_is_stored()
    {
        $user = $this->signIn();
        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image,
        ]);

        $this->assertCount(1, Storage::disk('public')->files('images'));

        $this->assertCount(1, $user->posts);

        $this->assertDatabaseHas('posts' , [
            'path' => 'images/' . $image->hashName(),
            'owner_id' => $user->id
        ]);
    }

    /** @test **/
    public function an_image_is_required_for_creating_a_new_post()
    {
        $this->signIn();

        $this->post('/posts' , [
            'image' => null
        ])->assertSessionHasErrors(['image']);
    }

    /** @test **/
    public function uploaded_file_must_be_an_image()
    {
        $this->signIn();

        $this->post('/posts', [
            'image' => UploadedFile::fake()->create('test.pdf')
        ])->assertSessionHasErrors(['image']);
    }

    /** @test **/
    public function a_user_can_see_an_uploaded_image()
    {
        $this->signIn();

        Storage::fake('public');

        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts' , [
            'image' => $image
        ]);

        $this->get('/posts')->assertSee($image->hashName());
    }
}
