@extends('layouts.app')

@section('title', empty($type->id) ? 'Creazione tipologia' : 'Modifica tipologia')

@section('content')
    <div class="container">
        <a href="{{ route('admin.types.index') }}" class="btn btn-primary mt-4 mb-3">Torna alla lista</a>

        <h1 class="mb-3">{{ empty($type->id) ? 'Crea Tipologia' : 'Modifica tipologia' }}</h1>

        <form action="{{ empty($type->id) ? route('admin.types.store') : route('admin.types.update', $type) }}"
            method="POST">
            @csrf

            @if (!empty($type->id))
                @method('PATCH')
            @endif

            <div class="row g-3">
                <div class="col-2">
                    <label for="color" class="form-label">Colore</label>
                    <input type="color" class="form-control @error('color') is-invalid @enderror" id="color"
                        name="color" value="{{ empty($type->id) ? '' : old('color', $type->color) }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-10">
                    <label for="type" class="form-label">Tipologia</label>
                    <input type="text" class="form-control @error('type') is-invalid @enderror" id="type"
                        name="type" value="{{ empty($type->id) ? '' : old('type', $type->type) }}">
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <button class="btn btn-success">{{ empty($type->id) ? 'Salva' : 'Modifica' }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
