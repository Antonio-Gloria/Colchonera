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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detalles del Documento</h4>
                    <span class="badge bg-{{ $financialDocument->document_type == 'income' ? 'success' : 'danger' }}">
                        {{ $financialDocument->document_type == 'income' ? 'Ingreso' : 'Salida' }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <h5>{{ $financialDocument->title }}</h5>
                    </div>

                    <div class="mb-3">
                        <p><strong>Fecha del documento:</strong> 
                           {{ $financialDocument->report_date->format('d/m/Y') }}</p>
                        <p><strong>Subido por:</strong> {{ $financialDocument->user->name }}</p>
                        <p><strong>Fecha de subida:</strong> 
                           {{ $financialDocument->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    @if($financialDocument->description)
                    <div class="mb-3">
                        <label class="form-label"><strong>Descripción:</strong></label>
                        <p>{{ $financialDocument->description }}</p>
                    </div>
                    @endif

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('financial-documents.download', $financialDocument) }}" 
                           class="btn btn-primary me-md-2">
                            <i class="fas fa-download"></i> Descargar PDF
                        </a>
                        <a href="{{ route('financial-documents.edit', $financialDocument) }}" 
                           class="btn btn-warning me-md-2">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('financial-documents.destroy', $financialDocument) }}" 
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('¿Eliminar este documento?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection