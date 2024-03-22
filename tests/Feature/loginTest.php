<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class loginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_login_is_ok(): void
    {
        $response = $this->post('/api/login', ['email' => Config::get('app.apiEmail'), 'password' => Config::get('app.apiPassword')]);

        $response->assertStatus(200);
    }
}
