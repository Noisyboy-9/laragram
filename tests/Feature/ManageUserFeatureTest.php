<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageUserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function after_regestering_a_new_user_a_unique_and_hashed_username_will_be_generated_for_it()
    {
        $user = factory(User::class)->raw();
        $user['password_confirmation'] = $user['password'];

        $this->post('/register' , $user);

        $this->assertDatabaseHas('users'  , [
            'name' => $user['name'],
            'email' => $user['email'],
        ]);

        $savedUser = User::first();
        $this->assertNotNull($savedUser->username);
    }
}
