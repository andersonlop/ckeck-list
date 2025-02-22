<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\DashboardController;


// Rota principal
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas de Autenticação
Route::middleware('guest')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Registro
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Esqueci a senha
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});

// Rota de Logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rotas de Perfil
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Rotas de Módulos
    Route::resource('modulos', ModuloController::class);

    // Rotas de Categorias
    Route::resource('categorias', CategoriaController::class);

    Route::get('/api/categorias', [TarefaController::class, 'getCategorias'])->name('api.categorias');

    // Rotas de Tarefas
    Route::prefix('tarefas')->group(function () {
        Route::get('/', [TarefaController::class, 'index'])->name('tarefas.index');
        Route::get('/create', [TarefaController::class, 'create'])->name('tarefas.create');
        Route::post('/', [TarefaController::class, 'store'])->name('tarefas.store');
        Route::get('/{tarefa}', [TarefaController::class, 'show'])->name('tarefas.show');
        Route::get('/{tarefa}/edit', [TarefaController::class, 'edit'])->name('tarefas.edit');
        Route::put('/{tarefa}', [TarefaController::class, 'update'])->name('tarefas.update');
        Route::delete('/{tarefa}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');
        
        // Rota adicional para atualização de status
        Route::patch('/{tarefa}/status', [TarefaController::class, 'updateStatus'])
            ->name('tarefas.update.status');
    });

    // Rota para buscar dados para o dashboard
    Route::prefix('api')->group(function () {
        Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])
            ->name('dashboard.stats');
        Route::get('/dashboard/recent-tasks', [DashboardController::class, 'getRecentTasks'])
            ->name('dashboard.recent-tasks');
    });
});

// Fallback route para páginas não encontradas
Route::fallback(function () {
    return redirect()->route('dashboard')->with('error', 'Página não encontrada.');
});