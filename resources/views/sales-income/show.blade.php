@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Reporte</h1>
    
    <div class="card">
        <div class="card-body">
            <h3>{{ $salesIncome->title }}</h3>
            <p><strong>Fecha de Reporte:</strong> {{ $salesIncome->report_date->format('d/m/Y') }}</p>
            <p><strong>Subido por:</strong> {{ $salesIncome->user->name }}</p>
            <p><strong>Descripción:</strong> {{ $salesIncome->description ?? 'N/A' }}</p>
            
            <div class="mt-4">
                <a href="{{ route('sales-income.download', $salesIncome) }}" class="btn btn-primary">
                    <i class="fas fa-download"></i> Descargar PDF
                </a>
                <a href="{{ route('sales-income.edit', $salesIncome) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="{{ route('sales-income.destroy', $salesIncome) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este reporte?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection