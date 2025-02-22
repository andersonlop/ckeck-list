<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }
}