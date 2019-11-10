<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeploySuccessfulTest extends TestCase
{
    public function testAdminPageUnauthorized()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
    }

    public function testAdminPageLogin()
    {
        $response = $this->get('/admin/login');

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

    public function testApiClients()
    {
        if (!defined('LARAVEL_START')) {
            define('LARAVEL_START', microtime(true));
        }

        $response = $this->get('/api/clients', [
            'Authorization' => 'Bearer Oa8cduFPjvzG4LYcWAVCHhlB8gfDlWZvROQ10qoODq0eTLEkFq518rDwCc5R',
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(200);
    }

    public function testAdminExists()
    {
        $this->assertDatabaseHas('users', ['email' => 'admin@mail.com']);
    }
}
