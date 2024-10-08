<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserNameRequest;
use App\Models\Imagem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserNameRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);


        // return response()->json([
        //     'success' => true,
        //     'message' => $request->hasFile('image'),
        //     'data'=> $user
        // ], 200);



        if ($request->hasFile('image')) {
            // Obtém a data atual no formato "dia-mês-ano"
            // return response()->json([
            //     'success' => true,
            //     'message' => 'tem imagem',
            //     'data'=> $user
            // ], 200);

            $dateFolder = now()->format('d-m-Y');

            // Verifica se existe alguma imagem do tipo "profile_picture" associada ao usuário
            $images = Imagem::where('user_id', $user_id)->where('tipo', 'profile_picture')->get();

            // Exclui as imagens do servidor e os registros do banco de dados
            foreach ($images as $image) {
                // Exclui a imagem do servidor
                if (\Storage::disk('public')->exists($image->caminho)) {
                    \Storage::disk('public')->delete($image->caminho);
                }
                // Exclui o registro do banco de dados
                $image->delete();
            }

            // Define o caminho completo onde a imagem será salva
            $filePath = $request->file('image')->store("profile_pictures/{$dateFolder}", 'public');

            // Cria um registro no modelo Imagem
            Imagem::create([
                'caminho' => $filePath,
                'tipo' => 'profile_picture',
                'user_id' => $user_id,
            ]);
        }

        // Atualiza o campo 'name' apenas se ele estiver presente e não for nulo
        $user->fill(array_filter($request->only('name'), function ($value) {
            return !is_null($value);
        }));

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'salvo',
            'data'=> $user
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

