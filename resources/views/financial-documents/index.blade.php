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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Documentos Financieros</h1>
        <a href="{{ route('financial-documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Documento
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="btn-group" role="group">
                <a href="{{ route('financial-documents.index') }}" 
                   class="btn btn-{{ !request()->has('type') ? 'primary' : 'outline-primary' }}">
                    Todos
                </a>
                <a href="{{ route('financial-documents.type', 'income') }}" 
                   class="btn btn-{{ request()->get('type') == 'income' ? 'primary' : 'outline-primary' }}">
                    <i class="fas fa-arrow-down text-success"></i> Ingresos
                </a>
                <a href="{{ route('financial-documents.type', 'expense') }}" 
                   class="btn btn-{{ request()->get('type') == 'expense' ? 'primary' : 'outline-primary' }}">
                    <i class="fas fa-arrow-up text-danger"></i> Salidas
                </a>
            </div>
        </div>
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
                        <th>Tipo</th>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $document)
                    <tr>
                        <td>
                            @if($document->document_type == 'income')
                                <span class="badge bg-success"><i class="fas fa-arrow-down"></i> Ingreso</span>
                            @else
                                <span class="badge bg-danger"><i class="fas fa-arrow-up"></i> Salida</span>
                            @endif
                        </td>
                        <td>{{ $document->title }}</td>
                        <td>{{ $document->report_date->format('d/m/Y') }}</td>
                        <td>{{ $document->user->name }}</td>
                        <td>
                            <a href="{{ route('financial-documents.show', $document) }}" 
                               class="btn btn-sm btn-info" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('financial-documents.edit', $document) }}" 
                               class="btn btn-sm btn-warning" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('financial-documents.destroy', $document) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        title="Eliminar"
                                        onclick="return confirm('¿Eliminar este documento?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $documents->links() }}
        </div>
    </div>
</div>
@endsection