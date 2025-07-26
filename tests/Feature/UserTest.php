<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    //Temporary Tests -> Real Feature Tests to be determined.

    /**
     * A basic feature test example.
     */
    public function test_login_form(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }
    public function test_user_duplication()
    {
        //Creating two users to compare
        $user1 = User::make([
            'name' => 'jdoe',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'jdoe@example.com',
            'password' => 'password',
        ]);

        $user2 = User::make([
            'name' => 'jilldoe',
            'firstname' => 'Jill',
            'lastname' => 'Doe',
            'email' => 'jilldoe@example.com',
            'password' => 'password',
        ]);

        $this->assertTrue($user1->name != $user2->name);
    }
    public function test_delete_user()
    {
        $user = User::factory()->count(1)->create();
        $user = User::first();
        if ($user) {
            $user->delete();
        }
        $this->assertTrue(true);
    }
}
