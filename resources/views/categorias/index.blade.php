@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Categorias</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">Nova Categoria</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Módulo</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nome }}</td>
                        <td>{{ $categoria->modulo->nome }}</td>
                        <td>{{ $categoria->descricao }}</td>
                        <td>
                            <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline">
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
