<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_user_can_upload_image_and_make_new_post()
    {
        $this->withoutExceptionHandling();
        Storage::fake('public');
        $image = UploadedFile::fake()->image('test.jpg');

        $this->post('/posts', [
            'image' => $image
        ]);

        $this->assertCount(1, Storage::disk('public')->files('images'));

        $this->assertDatabaseHas('posts' , [
            'path' => 'images/' . $image->hashName()
        ]);
    }

    /** @test **/
    public function an_image_is_required_for_creating_a_new_post()
    {
        $this->post('/posts' , [
            'image' => null
        ])->assertSessionHasErrors(['image']);
    }

    /** @test **/
    public function uploaded_file_must_be_an_image()
    {
        $this->post('/posts', [
            'image' => UploadedFile::fake()->create('test.pdf')
        ])->assertSessionHasErrors(['image']);
    }
}
