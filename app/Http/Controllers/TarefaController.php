<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Models\Modulo;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefas = Tarefa::with(['modulo', 'categoria'])->get();
        return view('tarefas.index', compact('tarefas'));
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }

    public function create()
    {
        $modulos = Modulo::all();
        return view('tarefas.create', compact('modulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'modulo_id' => 'required|exists:modulos,id',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $tarefa = new Tarefa($request->all());
        $tarefa->status = 'pendente';
        $tarefa->save();

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso.');
    }

    public function edit(Tarefa $tarefa)
    {
        $modulos = Modulo::all();
        $categorias = Categoria::where('modulo_id', $tarefa->modulo_id)->get();
        return view('tarefas.edit', compact('tarefa', 'modulos', 'categorias'));
    }

    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'modulo_id' => 'required|exists:modulos,id',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $tarefa->update($request->all());

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy(Tarefa $tarefa)
    {
        if ($tarefa->status !== 'pendente') {
            return redirect()->route('tarefas.index')
                ->with('error', 'Apenas tarefas com status pendente podem ser excluídas.');
        }

        $tarefa->delete();

        return redirect()->route('tarefas.index')
            ->with('success', 'Tarefa excluída com sucesso.');
    }

    public function getCategorias(Request $request)
    {
        $modulo_id = $request->input('modulo_id');
        $categorias = Categoria::where('modulo_id', $modulo_id)->get();
        return response()->json($categorias);
    }
}