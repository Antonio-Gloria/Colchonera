@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4">Editar Reporte</h1>
    
    <div class="card">
        <div class="card-body">
            <form action="{{ route('sales-income.update', $salesIncome) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Título *</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $salesIncome->title }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ $salesIncome->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="report_date">Fecha de Reporte *</label>
                    <input type="date" name="report_date" id="report_date" class="form-control" value="{{ $salesIncome->report_date->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="pdf_file">Archivo PDF (Actualizar)</label>
                    <input type="file" name="pdf_file" id="pdf_file" class="form-control-file" accept=".pdf">
                    <small class="form-text text-muted">Tamaño máximo: 10MB. Dejar en blanco para mantener el archivo actual.</small>
                    <div class="mt-2">
                        <a href="{{ route('sales-income.download', $salesIncome) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i> Ver archivo actual
                        </a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('sales-income.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection