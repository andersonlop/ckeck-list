<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;
use App\Models\Categoria;
use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalModulos = Modulo::count();
        $totalCategorias = Categoria::count();
        $totalTarefas = Tarefa::where('user_id', $user->id)->count();
        $tarefasPendentes = Tarefa::where('user_id', $user->id)->where('status', 'pendente')->count();
        $tarefasEmAndamento = Tarefa::where('user_id', $user->id)->where('status', 'em_andamento')->count();
        $tarefasConcluidas = Tarefa::where('user_id', $user->id)->where('status', 'concluida')->count();

        $tarefasRecentes = Tarefa::with(['modulo', 'categoria'])
            ->where('user_id', $user->id)
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
        $user = Auth::user();
        $stats = [
            'totalModulos' => Modulo::count(),
            'totalCategorias' => Categoria::count(),
            'totalTarefas' => Tarefa::where('user_id', $user->id)->count(),
            'tarefasPendentes' => Tarefa::where('user_id', $user->id)->where('status', 'pendente')->count(),
            'tarefasEmAndamento' => Tarefa::where('user_id', $user->id)->where('status', 'em_andamento')->count(),
            'tarefasConcluidas' => Tarefa::where('user_id', $user->id)->where('status', 'concluida')->count(),
        ];

        return response()->json($stats);
    }

    public function getRecentTasks()
    {
        $user = Auth::user();
        $tarefasRecentes = Tarefa::with(['modulo', 'categoria'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json($tarefasRecentes);
    }
}