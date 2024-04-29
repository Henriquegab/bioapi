<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    use HasFactory;

    protected $table = 'imagens';
    protected $fillable = ['caminho', 'tipo', 'animal_id', 'user_id'];

    // public function animal()
    // {
    //     return $this->hasMany(Animal::class, 'id');
    // }
}
