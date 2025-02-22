<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'modulo_id'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }
}