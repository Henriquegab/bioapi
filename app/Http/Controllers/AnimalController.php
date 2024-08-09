<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnimalRequest;
use App\Models\Animal;
use Exception;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try{
            $animal = Animal::where('publicado',0);

            return response()->json([
                'success' => true,
                'message' => 'Posts de animais ainda não publicados retornados!',
                'data' => $animal
            ], 200);
        }
        catch(Exception $e){
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
                'estado' => $request->estado,
                'cidade' => $request->cidade,
                'user_id' => auth()->user()->id
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cadastro feito com sucesso!',
                'data' => $animal
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //
    }
}
