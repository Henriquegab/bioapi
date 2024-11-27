<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Models\Animal;
use App\Models\Imagem;
use Exception;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Definir o valor padrão para o número de itens por página
            $perPage = $request->input('per_page', 10); // Se não for passado, o valor padrão é 10
            $page = $request->input('page', 1); // Se não for passado, a página padrão é 1

            // Paginação utilizando o método paginate() com a página e itens por página especificados
            $animal = Animal::with('imagem')
                ->where('publicado', 0)
                ->paginate($perPage, ['*'], 'page', $page); // Utilizando o 'page' vindo da requisição

            return response()->json([
                'success' => true,
                'message' => 'Posts de animais ainda não publicados retornados!',
                'data' => $animal->items(), // Apenas os itens da página atual
                'current_page' => $animal->currentPage(),
                'last_page' => $animal->lastPage(),
                'total' => $animal->total(),
                'per_page' => $animal->perPage(),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Posts de animais não publicados não retornados!',
            ], 500);
        }
    }

    public function publicados()
    {
        try{
            $animal = Animal::where('publicado', 1);

            return response()->json([
                'success' => true,
                'message' => 'Posts de animais publicados retornados!',
                'data' => $animal
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Posts de animais publicados não retornados!',

            ], 500);
        }


    }
    public function todos()
    {
        try{
            $animal = Animal::all();

            return response()->json([
                'success' => true,
                'message' => 'Posts de animais retornados!',
                'data' => $animal
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Posts de animais publicados não retornados!',

            ], 500);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnimalRequest $request)
    {

        try{
            $animal = Animal::create([
                'titulo' => $request->titulo,
                'animal' => $request->animal,
                'lat' => $request->lat,
                'lon' => $request->lon,
                'descricao' => $request->descricao,
                'estado' => "MG",
                'cidade' => "Montes Claros",
                'publicado' => 0,
                'user_id' => auth()->user()->id
            ]);

            if ($request->hasFile('imagem')) {


                $dateFolder = now()->format('d-m-Y');



                // Define o caminho completo onde a imagem será salva
                $filePath = $request->file('imagem')->store("animals/{$dateFolder}", 'public');

                // Cria um registro no modelo Imagem
                $imagem = Imagem::create([
                    'caminho' => $filePath,
                    'tipo' => 'animal',
                    'user_id' => auth()->user()->id,
                    'animal_id' => $animal->id
                ]);
            }



            return response()->json([
                'success' => true,
                'message' => 'Cadastro feito com sucesso!',
                'data' => [
                    'animal' => $animal,
                    'imagem' => $imagem
                ]
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Cadastro não realizado, erro de servidor!',
                "data" => $e->getMessage()

            ], 500);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        // $animal = Questionario::with('prontuario.prontuario-origem');

        // $animal->questionario->pronturario->



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
