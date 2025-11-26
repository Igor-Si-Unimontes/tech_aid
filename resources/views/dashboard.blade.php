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

    <div class="row mb-4">

        <div class="col-6">
            <h1 class="mb-0 text-black fw-bold">Pagina inicial</h1>
            <p class="text-muted">essa e a pagina inicial</p>
        </div>

        <div class="col-6 text-end d-flex justify-content-end align-items-start">
            <a href="{{ route('chamados.create') }}" class="btn btn-primary">Botao</a>
        </div>

    </div>
@endsection
