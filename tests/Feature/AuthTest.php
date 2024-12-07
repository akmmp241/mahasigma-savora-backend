<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_success_register(): void
    {
        $response = $this->post('/api/v1/auth/register', [
            'email' => 'admin@savora.co.id',
            'password' => '12345678Ab',
            'name' => 'savora',
            'password_confirmation' => '12345678Ab'
        ]);

        $response->assertStatus(201);
        print_r($response->getContent());
    }

    public function test_validation_error(): void
    {
        $response = $this->post('/api/v1/auth/register');

        $response->assertStatus(400);
        print_r($response->getContent());
    }

    public function test_credential_already_taken()
    {
        User::query()->create([
            'email' => 'admin@savora.co.id',
            'password' => '12345678Ab',
            'name' => 'savora'
        ]);

        $response = $this->post('/api/v1/auth/register', [
            'email' => 'admin@savora.co.id',
            'password' => '12345678Ab',
            'name' => 'savora',
            'password_confirmation' => '12345678Ab'
        ]);

        $response->assertStatus(409);
        print_r($response->getContent());
    }

    public function test_success_login()
    {
        User::query()->create([
            'email' => 'admin@savora.co.id',
            'password' => '12345678Ab',
            'name' => 'savora'
        ]);

        $response = $this->post('/api/v1/auth/login', [
            'email' => 'admin@savora.co.id',
            'password' => '12345678Ab',
        ]);

        $response->assertStatus(200);
        print_r($response->getContent());
    }

    public function test_invalid_credential()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'notfound@gmail.com',
            'password' => 'auasdn1283nAa'
        ]);

        $response->assertStatus(401);
        print_r($response->getContent());
    }

    public function test_failed_validation()
    {
        $response = $this->post('/api/v1/auth/login');

        $response->assertStatus(400);
        print_r($response->getContent());
    }
}
