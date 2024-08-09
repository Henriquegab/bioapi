<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Services\JwtTokenService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AnimalTest extends TestCase
{


    private $jwt;
    private $animalId;


    public function setUp(): void
    {
        parent::setUp();
        $this->jwt = app(JwtTokenService::class);
    }

    /**
     * A basic feature test example.
     */
    public function test_if_store_animal_is_ok(): void
    {

        $headers = $this->jwt->getHeaderForTest();

        $response = $this->json('POST', '/api/animal',
        [
        'titulo' => 'test',
        'descricao' => 'test@',
        'lat' => '1',
        'lon' => '1',
        'estado' => 'MG',
        'cidade' => 'montes claros'
        ]
        , $headers);


        // dd($response);

        Animal::destroy($response->json('data.id'));

        $response->assertStatus(201);
    }

    // public function test_if_delete_animal_is_ok(): void
    // {

    //     $headers = $this->jwt->getHeaderForTest();


    //     $response = $this->json('DELETE', '/api/animal/'.$this->animalId,

    //     [], $headers);


    //     // dd($response);

    //     $response->assertStatus(200);
    // }
}
