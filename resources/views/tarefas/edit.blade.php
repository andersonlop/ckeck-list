@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Tarefa</h1>
        <form action="{{ route('tarefas.update', $tarefa) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                    value="{{ old('titulo', $tarefa->titulo) }}" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" required>{{ old('descricao', $tarefa->descricao) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="modulo_id" class="form-label">Módulo</label>
                <select class="form-control" id="modulo_id" name="modulo_id" required>
                    <option value="">Selecione um módulo</option>
                    @foreach ($modulos as $modulo)
                        <option value="{{ $modulo->id }}"
                            {{ old('modulo_id', $tarefa->modulo_id) == $modulo->id ? 'selected' : '' }}>
                            {{ $modulo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">Selecione uma categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ old('categoria_id', $tarefa->categoria_id) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pendente" {{ old('status', $tarefa->status) == 'pendente' ? 'selected' : '' }}>Pendente
                    </option>
                    <option value="em_andamento"
                        {{ old('status', $tarefa->status) == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
                    <option value="concluida" {{ old('status', $tarefa->status) == 'concluida' ? 'selected' : '' }}>
                        Concluída</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Tarefa</button>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const moduloSelect = document.getElementById('modulo_id');
                const categoriaSelect = document.getElementById('categoria_id');

                moduloSelect.addEventListener('change', function() {
                    const moduloId = this.value;
                    if (moduloId) {
                        fetch(`/api/categorias?modulo_id=${moduloId}`)
                            .then(response => response.json())
                            .then(data => {
                                categoriaSelect.innerHTML =
                                    '<option value="">Selecione uma categoria</option>';
                                data.forEach(categoria => {
                                    const option = document.createElement('option');
                                    option.value = categoria.id;
                                    option.textContent = categoria.nome;
                                    categoriaSelect.appendChild(option);
                                });
                                categoriaSelect.disabled = false;
                            });
                    } else {
                        categoriaSelect.innerHTML = '<option value="">Selecione uma categoria</option>';
                        categoriaSelect.disabled = true;
                    }
                });

                // Carregar categorias iniciais se um módulo já estiver selecionado
                if (moduloSelect.value) {
                    moduloSelect.dispatchEvent(new Event('change'));
                }
            });
        </script>
    @endpush
@endsection
