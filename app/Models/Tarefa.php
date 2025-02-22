<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao', 'modulo_id', 'categoria_id', 'status'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}