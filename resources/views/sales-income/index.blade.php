@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4">Reportes de Ventas e Ingresos</h1>
    
    <div class="mb-4">
        <a href="{{ route('sales-income.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Reporte
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Fecha de Reporte</th>
                        <th>Subido por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pdfs as $pdf)
                    <tr>
                        <td>{{ $pdf->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($pdf->report_date)->format('d/m/Y') }}</td>
                        <td>{{ $pdf->user->name }}</td>
                        <td>
                            <a href="{{ route('sales-income.show', $pdf) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('sales-income.edit', $pdf) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('sales-income.destroy', $pdf) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este reporte?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $pdfs->links() }}
        </div>
    </div>
</div>
@endsection