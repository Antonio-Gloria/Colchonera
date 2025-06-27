@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subir nuevo PDF</h2>

    <form action="{{ route('pdf.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Título del PDF</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="pdf_path">Archivo PDF</label>
            <input type="file" name="pdf_path" accept="application/pdf" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Subir</button>
    </form>
</div>
@endsection
