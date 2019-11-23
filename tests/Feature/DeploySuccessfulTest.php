<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeploySuccessfulTest extends TestCase
{
    public function testAdminPageUnauthorized()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testAdminPageLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function testApiUnauthorized()
    {
        if (!defined('LARAVEL_START')) {
            define('LARAVEL_START', microtime(true));
        }

        $response = $this->get('/api/clients', ['Accept' => 'application/json']);

        $response->assertStatus(401);
    }

    public function testAdminExists()
    {
        $this->assertDatabaseHas('users', ['email' => 'admin@mail.com']);
    }
}
