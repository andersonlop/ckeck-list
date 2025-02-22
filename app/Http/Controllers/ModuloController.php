<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index()
    {
        $modulos = Modulo::all();
        return view('modulos.index', compact('modulos'));
    }

    public function create()
    {
        return view('modulos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        Modulo::create($request->all());

        return redirect()->route('modulos.index')->with('success', 'Módulo criado com sucesso.');
    }

    public function edit(Modulo $modulo)
    {
        return view('modulos.edit', compact('modulo'));
    }

    public function update(Request $request, Modulo $modulo)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        $modulo->update($request->all());

        return redirect()->route('modulos.index')->with('success', 'Módulo atualizado com sucesso.');
    }

    public function destroy(Modulo $modulo)
    {
        $modulo->delete();

        return redirect()->route('modulos.index')->with('success', 'Módulo excluído com sucesso.');
    }
}