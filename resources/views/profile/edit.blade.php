@extends('layouts.app')

@section('header')
    <h2 class="h4 mb-4">
        {{ __('Perfil') }}
    </h2>
@endsection

@section('content')
    <div class="row g-4">

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
@endsection
