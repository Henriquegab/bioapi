<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Exception;
use Illuminate\Http\Request;

class AnimalWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

            // // Definir o valor padrão para o número de itens por página
            // $perPage = $request->input('per_page', 10); // Se não for passado, o valor padrão é 10
            // $page = $request->input('page', 1); // Se não for passado, a página padrão é 1

            // // Paginação utilizando o método paginate() com a página e itens por página especificados
            // $animais = Animal::with('imagem')
            // ->where('publicado', 0)
            // ->paginate($perPage, ['*'], 'page', $page); // Utilizando o 'page' vindo da requisição

            // return view('animal.index', ['animais' => $animais]);

            $animais = Animal::with('imagem')->search($request)
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

            return view('animal.index', ['animais' => $animais]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $animal = Animal::with('imagem')->findOrFail($id);

        $coordenada = ['lat' => $animal->lat, 'lng' => $animal->lon, 'titulo' => $animal->titulo];

        return view('animal.show', ['animal' => $animal, 'coordenada' => $coordenada]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $animal = Animal::with('imagem')->findOrFail($id);

        return view('animal.edit', ['animal' => $animal]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
