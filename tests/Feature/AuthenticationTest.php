<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_render_signup_form(): void
    {
        $response = $this->get('/auth/signup');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/auth/signup', [
            'username' => 'Mohammed',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('email/verify');
    }

    public function test_failed_register_new_users(){
        $response = $this->post('/auth/signup', [
            'username' => 'Mohammed',
            'email' => 'test@example.com',
            'password' => 'passwd',
            'password_confirmation' => 'password',
        ]);
        $this->assertGuest($guard = null);
        $response->assertStatus(302);
    }



    public function test_render_user_login_form() {
        $response = $this->get('/auth/login');
        $response->assertStatus(200);
    }

    public function test_can_user_login() {
       $this->post('/auth/signup', [
            'username' => 'Mohammed',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response = $this->post('/auth/login',
        ['login'=> 'Mohammed', 'password' => 'password']);
        $this->assertAuthenticated();
        $response->assertStatus(302);
        $response->assertRedirectToRoute('home');

    }

    public function test_failed_user_login () {
        $this->post('/auth/signup', [
            'username' => 'Mohammed',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

      $this->post('/auth/login',
        ['login'=> 'Mohammed12', 'password' => 'password']);

        $this->post('/auth/logout');

        $response = $this->post('/auth/login',
        ['login'=> 'Mohammed12', 'password' => 'password']);

        $response->assertStatus(302);

    }


}
