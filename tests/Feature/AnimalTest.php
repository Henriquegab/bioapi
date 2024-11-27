<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\Imagem;
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

        $imageUrl = 'https://avatars.githubusercontent.com/u/67250181?v=4';
        $imageContents = file_get_contents($imageUrl);
        $tempFilePath = tempnam(sys_get_temp_dir(), 'upload');
        file_put_contents($tempFilePath, $imageContents);

        $response = $this->json('POST', '/api/animal',
        [
        'titulo' => 'test',
        'descricao' => 'test@',
        'lat' => '1',
        'lon' => '1',
        'estado' => 'MG',
        'cidade' => 'montes claros',
        'imagem' => new \Illuminate\Http\UploadedFile($tempFilePath, 'image.jpg', null, null, true)
        ]
        , $headers);


        // dd($response);

        Animal::destroy($response->json('data.animal.id'));
        Imagem::destroy($response->json('data.imagem.id'));
        \Storage::disk('public')->delete($response->json('data.imagem.caminho'));

        $response->assertStatus(201);
    }

    public function test_if_index_animal_is_ok(): void
    {

        $headers = $this->jwt->getHeaderForTest();
        $response = $this->json('GET', '/api/animal',[], $headers);




        $response->assertStatus(200);
    }


}
