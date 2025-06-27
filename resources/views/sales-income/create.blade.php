@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4">Subir Nuevo Reporte</h1>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('sales-income.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">Título *</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="report_date">Fecha de Reporte *</label>
                    <input type="date" name="report_date" id="report_date" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="pdf_file">Archivo PDF *</label>
                    <input type="file" name="pdf_file" id="pdf_file" class="form-control-file" accept=".pdf" required>
                    <small class="form-text text-muted">Tamaño máximo: 10MB</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('sales-income.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection