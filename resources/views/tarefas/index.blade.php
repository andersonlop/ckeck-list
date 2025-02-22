@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tarefas</h1>
    <a href="{{ route('tarefas.create') }}" class="btn btn-primary mb-3">Nova Tarefa</a>
    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Módulo</th>
                <th>Categoria</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa->titulo }}</td>
                    <td>{{ $tarefa->modulo->nome }}</td>
                    <td>{{ $tarefa->categoria->nome }}</td>
                    <td>
                        <span class="badge bg-{{ $tarefa->status == 'pendente' ? 'warning' : ($tarefa->status == 'em_andamento' ? 'primary' : 'success') }}">
                            {{ ucfirst(str_replace('_', ' ', $tarefa->status)) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('tarefas.show', $tarefa) }}" class="btn btn-sm btn-info">Visualizar</a>
                        <a href="{{ route('tarefas.edit', $tarefa) }}" class="btn btn-sm btn-primary">Editar</a>
                        @if($tarefa->status == 'pendente')
                            <form action="{{ route('tarefas.destroy', $tarefa) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">
                                    Excluir
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection