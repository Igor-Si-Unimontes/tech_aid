@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row mb-4 align-items-center">
        <div class="col-12 col-md-6">
            <h1 class="mb-0 text-black fw-bold">Editar Chamado {{ $chamado->title }}</h1>
        </div>
        <div class="col-12 col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('chamados.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('chamados.update', $chamado->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $chamado->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $chamado->description }}</textarea>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            @foreach(\App\Enum\Status::cases() as $status)                                
                                <option value="{{ $status->value }}" {{ $chamado->status->value === $status->value ? 'selected' : '' }}>{{ $status->label() }}</option>                                
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="priority" class="form-label">Prioridade</label>
                        <select name="priority" id="priority" class="form-select" required>
                            @foreach(\App\Enum\Priority::cases() as $priority)                                
                                <option value="{{ $priority->value }}" {{ $chamado->priority->value === $priority->value ? 'selected' : '' }}>{{ $priority->label() }}</option>                                
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Atualizar Chamado</button>
            </form>
        </div>
    </div>
@endsection
