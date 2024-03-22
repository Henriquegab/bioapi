<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\JwtTokenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{

    // use RefreshDatabase;

    private $jwt;


    public function setUp(): void
    {
        parent::setUp();
        $this->jwt = app(JwtTokenService::class);
    }


    /**
     * A basic feature test example.
     */
    public function test_if_register_is_ok(): void
    {
        $headers = $this->jwt->getHeaderForTest();

        $response = $this->json('POST', '/api/register', ['name' => 'test', 'email' => 'test@test1.com', 'password' => '123456789'], $headers);

         $response->assertStatus(201)
             ->assertJson([
                 'success' => true,

             ]);

    }
    public function test_if_delete_user_is_ok(): void
    {


        $user = User::where('email', "test@test1.com")->first();

        if(!is_null($user)){
            $user->delete();
            $this->assertTrue(true);

        }
        else{
            $this->assertFalse(true);
        }





    }
}
