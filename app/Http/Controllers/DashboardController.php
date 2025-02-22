<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Categoria;
use App\Models\Tarefa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalModulos = Modulo::count();
        $totalCategorias = Categoria::count();
        $totalTarefas = Tarefa::count();
        $tarefasPendentes = Tarefa::where('status', 'pendente')->count();
        $tarefasEmAndamento = Tarefa::where('status', 'em_andamento')->count();
        $tarefasConcluidas = Tarefa::where('status', 'concluida')->count();

        $tarefasRecentes = Tarefa::with(['modulo', 'categoria'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalModulos',
            'totalCategorias',
            'totalTarefas',
            'tarefasPendentes',
            'tarefasEmAndamento',
            'tarefasConcluidas',
            'tarefasRecentes'
        ));
    }

    public function getStats()
    {
        $stats = [
            'totalModulos' => Modulo::count(),
            'totalCategorias' => Categoria::count(),
            'totalTarefas' => Tarefa::count(),
            'tarefasPendentes' => Tarefa::where('status', 'pendente')->count(),
            'tarefasEmAndamento' => Tarefa::where('status', 'em_andamento')->count(),
            'tarefasConcluidas' => Tarefa::where('status', 'concluida')->count(),
        ];

        return response()->json($stats);
    }

    public function getRecentTasks()
    {
        $tarefasRecentes = Tarefa::with(['modulo', 'categoria'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json($tarefasRecentes);
    }
}