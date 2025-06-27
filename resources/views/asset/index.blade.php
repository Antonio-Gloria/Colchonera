@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row mb-4"> 
        <h2 class="col">Galería de Videos</h2>
        <div class="col text-end">
            <a href="{{ route('asset.create') }}" class="btn btn-success">Subir nuevo video</a>
        </div>
    </div>

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="row">
        @forelse($assets as $asset)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ route('imageVideo', $asset->image) }}" class="card-img-top" alt="Miniatura de {{ $asset->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $asset->title }}</h5>
                        <a href="{{ route('asset.show', $asset->id) }}" class="btn btn-primary">Ver video</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">No hay videos subidos aún.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
