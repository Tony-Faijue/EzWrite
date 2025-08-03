<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that guest can register with valid data
     * @return void
     */
    public function test_guest_can_register_with_valid_data()
    {
        //Ensure user is a guest before registration
        $this->assertGuest();

        //Create user data
        $data = [
            'name' => 'bobbyBig132',
            'firstname' => 'Bob',
            'lastname' => 'Handsome',
            'email' => 'bob@example.com',
            'password' => 'secret123',
        ];

        //Execute registration request/ Attempt to register
        $response = $this->post(route('register'), $data);

        //Assert the user is redirected to user home page
        $response->assertRedirect(route('user-home'));

        //Assert the user is in the database
        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
        ]);

        //Assert the user that was just registered is authenticated
        $user = User::where('email', $data['email'])->first();
        $this->assertAuthenticatedAs($user);

    }
    /**
     * Test guest cannot register with invalid data
     * @return void
     */
    public function test_guest_cannot_register_with_invalid_data()
    {

        //Ensure user is a guest before registration
        $this->assertGuest();

        //Create user data that will fail
        $data = [
            'name' => 'bobbyBig132',
            'firstname' => 'Bob',
            'lastname' => 'Handsome',
            'email' => 'bob^&%example.com', //invalid format
            'password' => 'pa',         //too short
            'password_confirmation' => 'pa',
        ];

        //Attempt to register
        $response = $this
            ->from(route('register'))
            ->post(route('register'), $data);

        //Assert that the user is redirected to register page and the error occurs
        $response->assertRedirect(route('register'));

        $response->assertSessionHasErrors([
            'email',
            'password',
        ]);

        //Assert that user is stil a guest
        $this->assertGuest();

    }
    /**
     * Test if user can login with valid credentials.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        //Create a user
        $user = User::factory()->create([
            'password' => Hash::make('secret123'),
        ]);

        //Attempt to login
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        //Assert that user is authenticated and redirected to user homepage
        $response->assertRedirect(route('user-home'));
        $this->assertAuthenticatedAs($user);
    }
    /**
     * Test that the user cannot login with invalid credentials 
     * @return void
     */
    public function test_user_cannot_login_with_invalid_credentials()
    {
        //Create a user
        $user = User::factory()->create([
            'password' => Hash::make('secret123'),
        ]);
        //Attempt to login
        //Use of from here ensure a failed login redirects back to the login url
        $response = $this
            ->from(route('login'))
            ->post(route('login'), [
                'email' => $user->email,
                'password' => 'wrongpassword',
            ]);

        //Assert that the user is redirected to login and that error occurs
        $response->assertRedirect(route('login'))
            ->assertSessionHasErrors('login');
        //Assert that the user is not authenticated
        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        //Create User and Authenticate them
        $user = User::factory()->create();
        //Set the current logged in user as $user
        $this->actingAs($user);
        $this->assertAuthenticated();

        //Attempt to logout
        $response = $this->post(route('logout'));

        //Assert the user is redirected to blog home page and is a guest
        $response->assertRedirect(route('home'));
        $this->assertGuest();

    }
}
