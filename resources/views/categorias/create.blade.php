@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Categoria</h1>
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao">{{ old('descricao') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="modulo_id" class="form-label">Módulo</label>
            <select class="form-control" id="modulo_id" name="modulo_id" required>
                <option value="">Selecione um módulo</option>
                @foreach($modulos as $modulo)
                    <option value="{{ $modulo->id }}" {{ old('modulo_id') == $modulo->id ? 'selected' : '' }}>
                        {{ $modulo->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Criar Categoria</button>
    </form>
</div>
@endsection