<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'Animais';
    protected $fillable = ['titulo','animal', 'descricao','publicado', 'lat', 'lon','cidade','estado','user_id'];

    public function imagem()
    {
        return $this->hasMany(Imagem::class, 'animal_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function scopeSearch($query, $request)
    {
        return $query
            // ->when($request->dias, function ($query, $dias) {
            //     foreach ($dias as $dia) {
            //         $query->orWhereRelation('dias', 'dia_id', $dia);
            //     }

            //     return $query;
            // })
            // ->when($request->aluno, function ($query, $aluno) {
            //     return $query->whereRelation('user', 'name', 'like', '%'.$aluno.'%');
            // })
            ->when($request->titulo, function ($query, $titulo) {
                return $query->where('titulo', 'like', '%'.$titulo.'%');
            })
            ->when($request->animal, function ($query, $animal) {
                return $query->where('animal', 'like', '%'.$animal.'%');
            })
            // ->when($request->cpf, function ($query, $cpf) {
            //     return $query->whereRelation('user', 'cpf', 'like', '%'.$cpf.'%');
            // })
            ->when($request->publicado, function ($query, $publicado) {
                // if ($publicado == 'Geral') {
                //     return $query;
                // }

                return $query->where('publicado', '=', $publicado);
            });
    }
}
