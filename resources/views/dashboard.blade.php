@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Dashboard</h1>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Módulos</h5>
                        <p class="card-text display-4">{{ $totalModulos }}</p>
                        <a href="{{ route('modulos.index') }}" class="btn btn-primary">Ver Módulos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categorias</h5>
                        <p class="card-text display-4">{{ $totalCategorias }}</p>
                        <a href="{{ route('categorias.index') }}" class="btn btn-primary">Ver Categorias</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Tarefas</h5>
                        <p class="card-text display-4">{{ $totalTarefas }}</p>
                        <a href="{{ route('tarefas.index') }}" class="btn btn-primary">Ver Tarefas</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Status das Tarefas</h5>
                        <canvas id="tarefasChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tarefas Recentes</h5>
                        <ul class="list-group">
                            @foreach ($tarefasRecentes as $tarefa)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $tarefa->titulo }}</h6>
                                        <small>{{ $tarefa->modulo->nome }} - {{ $tarefa->categoria->nome }}</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ ucfirst($tarefa->status) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('tarefasChart').getContext('2d');
            var tarefasChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Pendentes', 'Em Andamento', 'Concluídas'],
                    datasets: [{
                        data: [{{ $tarefasPendentes }}, {{ $tarefasEmAndamento }},
                            {{ $tarefasConcluidas }}
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(75, 192, 192, 0.8)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        });
    </script>
@endpush
