@extends('layouts.app')

@section('title')
    {{ $technology->type }}
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary mt-4 mb-3">Torna alla lista</a>
        <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-primary mt-4 mb-3">Modifica</a>

        <h1 class="mt-3 fw-bold">{{ $technology->type }}</h1>

        <span class="mt-4 fs-5 fw-bold d-block">Badge: {!! $technology->getBadge() !!}</span>

    </div>
@endsection
