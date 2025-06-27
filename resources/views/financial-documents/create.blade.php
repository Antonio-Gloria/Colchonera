@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
    <style>
        div.dt-buttons {
            display: inline-block !important;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Subir Nuevo Documento Financiero</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('financial-documents.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="document_type" class="form-label">Tipo de Documento *</label>
                            <select name="document_type" id="document_type" class="form-select" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="income">Ingreso</option>
                                <option value="expense">Salida</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Título *</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   required minlength="5" maxlength="100">
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="3" maxlength="255"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="report_date" class="form-label">Fecha del Documento *</label>
                            <input type="date" class="form-control" id="report_date" 
                                   name="report_date" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="document_file" class="form-label">Archivo PDF *</label>
                            <input type="file" class="form-control" id="document_file" 
                                   name="document_file" accept=".pdf" required>
                            <div class="form-text">Tamaño máximo: 10MB</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('financial-documents.index') }}" 
                               class="btn btn-secondary me-md-2">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Documento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection