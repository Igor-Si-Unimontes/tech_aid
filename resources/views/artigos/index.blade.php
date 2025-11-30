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
            <h1 class="mb-0 text-black fw-bold">Artigos</h1>
            <p class="text-muted">Lista de artigos publicados</p>
        </div>

        <div class="col-6 text-end d-flex justify-content-end align-items-start">
            <a href="{{ route('artigos.create') }}" class="btn btn-primary me-2">
                Novo Artigo <i class="fa fa-plus"></i>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-12">

            @if ($artigos->isEmpty())
                <div class="alert alert-info">
                    Nenhum artigo encontrado.
                </div>
            @endif

            @if ($artigos->isNotEmpty())
                <div class="accordion" id="accordionExample">

                    @foreach ($artigos as $artigo)
                        @php
                            $collapseId = 'collapse-' . $artigo->id;
                            $headingId = 'heading-' . $artigo->id;
                        @endphp

                        <div class="accordion-item">

                            <h2 class="accordion-header" id="{{ $headingId }}">
                                <div class="d-flex justify-content-between align-items-center w-100">

                                    <button class="accordion-button collapsed flex-grow-1 text-start" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $collapseId }}"
                                        aria-expanded="false" aria-controls="{{ $collapseId }}">
                                        {{ $artigo->title }}
                                    </button>

                                    <div class="ms-3 me-3 d-flex align-items-center">

                                        <a href="{{ route('artigos.edit', $artigo->id) }}"
                                            class="btn btn-outline-secondary btn-sm me-1" title="Editar">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalDelete-{{ $artigo->id }}" title="Excluir">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <div class="modal fade" id="modalDelete-{{ $artigo->id }}" tabindex="-1"
                                            aria-labelledby="modalLabel-{{ $artigo->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalLabel-{{ $artigo->id }}">
                                                            Confirmar exclusão</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <p style="font-size: 20px;">Tem certeza que deseja excluir o artigo
                                                            <strong>"{{ $artigo->title }}"</strong>?
                                                        </p>

                                                        <small class="text-muted" style="font-size: 18px;">Esta ação não
                                                            poderá ser desfeita.</small>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar</button>

                                                        <form action="{{ route('artigos.destroy', $artigo->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger">
                                                                Excluir
                                                            </button>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </h2>

                            <div id="{{ $collapseId }}" class="accordion-collapse collapse"
                                aria-labelledby="{{ $headingId }}" data-bs-parent="#accordionExample">

                                <div class="accordion-body">

                                    <div class="mb-3">
                                        <p class="mb-0" style="white-space: pre-line;">
                                            {{ $artigo->content }}
                                        </p>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-3"
                                        style="font-size: 0.85rem; color: #555;">

                                        <div>
                                            <strong>Tags:</strong> {{ $artigo->tags ?? '' }}
                                        </div>

                                        <div>
                                            <strong>Categoria:</strong> {{ $artigo->category ?? '' }}
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
@endsection
