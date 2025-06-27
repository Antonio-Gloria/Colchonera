@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Subir nuevo video</h2>
    </div>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! Algo salió mal:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asset.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="image">Miniatura (jpg, png, gif):</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="video_path">Video (mp4):</label>
            <input type="file" name="video_path" id="video_path" class="form-control-file" accept="video/mp4" required>
        </div>

        <button type="submit" class="btn btn-primary">Subir video</button>
    </form>
</div>
@endsection
