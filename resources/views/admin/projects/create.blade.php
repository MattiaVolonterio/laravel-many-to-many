@extends('layouts.app')

@section('title', 'Nuovo Progetto')

@section('content')
    <div class="container">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary mt-4 mb-3">Torna alla lista</a>

        <h1 class="mb-3">Inserisci un nuovo progetto</h1>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <div class="col-6">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="author" class="form-label">Autore</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author"
                                name="author" value="{{ old('author') }}">
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="project_link" class="form-label">Link al progetto</label>
                            <input type="url" class="form-control @error('project_link') is-invalid @enderror"
                                id="project_link" name="project_link" value="{{ old('project_link') }}">
                            @error('project_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="type_id" class="form-label">Tipologia di progetto</label>
                            <select name="type_id" id="type_id"
                                class='form-select @error('type_id') is-invalid @enderror'>
                                <option value="" class="d-none">Seleziona una tipologia</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="project_image" class="form-label">Immagine</label>
                            <input type="file" name="project_image" id="project_image"
                                class="form-control @error('project_image') is-invalid @enderror">
                            @error('project_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <label class="form-label">Tecnologie</label>
                    @foreach ($technologies as $technology)
                        <div @class(['form-check', 'is-invalid' => $errors->has('technologies')])>
                            <input
                                {{ in_array($technology->id, old('technologies', $project_technology_id ?? [])) ? 'checked' : '' }}
                                class="form-check-input  @error('technologies') is-invalid @enderror" type="checkbox"
                                value="{{ $technology->id }}" name="technologies[]"
                                id="technologies-{{ $technology->id }}">
                            <label class="form-check-label" for="technologies-{{ $technology->id }}">
                                {{ $technology->type }}
                            </label>
                        </div>
                    @endforeach
                    @error('technologies')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-2">
                    <button class="btn btn-success">Salva</button>
                </div>
            </div>
        </form>
    </div>
@endsection
