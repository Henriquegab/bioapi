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
}
