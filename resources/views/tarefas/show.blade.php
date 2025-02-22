@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detalhes da Tarefa</h5>
                        <div>
                            <a href="{{ route('tarefas.index') }}" class="btn btn-secondary">Voltar</a>
                            <a href="{{ route('tarefas.edit', $tarefa) }}" class="btn btn-primary">Editar</a>
                            @if ($tarefa->status == 'pendente')
                                <form action="{{ route('tarefas.destroy', $tarefa) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                        Excluir
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h3>{{ $tarefa->titulo }}</h3>
                            <span
                                class="badge bg-{{ $tarefa->status == 'pendente' ? 'warning' : ($tarefa->status == 'em_andamento' ? 'primary' : 'success') }} mb-3">
                                {{ ucfirst(str_replace('_', ' ', $tarefa->status)) }}
                            </span>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6>Módulo</h6>
                                <p>{{ $tarefa->modulo->nome }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Categoria</h6>
                                <p>{{ $tarefa->categoria->nome }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6>Descrição</h6>
                            <p class="text-muted">{{ $tarefa->descricao }}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h6>Criado em</h6>
                                <p>{{ $tarefa->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Última atualização</h6>
                                <p>{{ $tarefa->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
