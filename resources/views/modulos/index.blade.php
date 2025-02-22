@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Módulos</h1>
        <a href="{{ route('modulos.create') }}" class="btn btn-primary mb-3">Novo Módulo</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modulos as $modulo)
                    <tr>
                        <td>{{ $modulo->nome }}</td>
                        <td>{{ $modulo->descricao }}</td>
                        <td>
                            <a href="{{ route('modulos.edit', $modulo) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('modulos.destroy', $modulo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
