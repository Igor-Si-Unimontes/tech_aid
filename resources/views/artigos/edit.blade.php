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
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row mb-4 align-items-center">
        <div class="col-12 col-md-6">
            <h1 class="mb-0 text-black fw-bold">Criar Novo Artigo</h1>
        </div>
        <div class="col-12 col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('artigos.index') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{ route('artigos.update', $artigo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $artigo->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Conteúdo</label>
                    <textarea class="form-control" id="content" name="content" rows="4" required>{{ old('content', $artigo->content) }}</textarea>
                </div>
               <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags', $artigo->tags) }}" required>
                </div>
               <div class="mb-3">
                    <label for="category" class="form-label">Categoria</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $artigo->category) }}">
                </div>

                <button type="submit" class="btn btn-success">Atualizar Artigo</button>
            </form>
        </div>
    </div>
@endsection
