@extends('layouts.app')

@section('title', empty($technology->id) ? 'Creazione tecnologia' : 'Modifica tecnologia')

@section('content')
    <div class="container">
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary mt-4 mb-3">Torna alla lista</a>

        <h1 class="mb-3">{{ empty($technology->id) ? 'Crea Tecnologia' : 'Modifica Tecnologia' }}</h1>

        <form
            action="{{ empty($technology->id) ? route('admin.technologies.store') : route('admin.technologies.update', $technology) }}"
            method="POST">
            @csrf

            @if (!empty($technology->id))
                @method('PATCH')
            @endif

            <div class="row g-3">
                <div class="col-2">
                    <label for="color" class="form-label">Colore</label>
                    <input type="color" class="form-control @error('color') is-invalid @enderror" id="color"
                        name="color" value="{{ empty($technology->id) ? '' : old('color', $technology->color) }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-10">
                    <label for="type" class="form-label">Tecnologia</label>
                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                        name="type" value="{{ empty($technology->id) ? '' : old('type', $technology->type) }}">
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <button class="btn btn-success">{{ empty($technology->id) ? 'Salva' : 'Modifica' }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
