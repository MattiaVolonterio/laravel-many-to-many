@extends('layouts.app')

@section('title')
    {{ $type->type }}
@endsection

@section('content')
    <div class="container">
        <a href="{{ route('admin.types.index') }}" class="btn btn-primary mt-4 mb-3">Torna alla lista</a>
        <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-primary mt-4 mb-3">Modifica</a>

        <h1 class="mt-3 fw-bold">{{ $type->type }}</h1>

        <span class="mt-4 fs-5 fw-bold d-block">Badge: {!! $type->getBadge() !!}</span>

    </div>
@endsection
