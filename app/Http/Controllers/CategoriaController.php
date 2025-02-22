<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Modulo;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with('modulo')->get();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        $modulos = Modulo::all();
        return view('categorias.create', compact('modulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'modulo_id' => 'required|exists:modulos,id',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso.');
    }

    public function edit(Categoria $categoria)
    {
        $modulos = Modulo::all();
        return view('categorias.edit', compact('categoria', 'modulos'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'modulo_id' => 'required|exists:modulos,id',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso.');
    }
}