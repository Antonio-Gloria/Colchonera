@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de PDFs</h2>

    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <a href="{{ route('pdf.create') }}" class="btn btn-primary mb-3">Subir nuevo PDF</a>

    @if ($pdfs->isEmpty())
        <p>No hay archivos PDF subidos aún.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pdfs as $pdf)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pdf->title }}</td>
                        <td>
                            <a href="{{ route('pdf.get', $pdf->pdf_path) }}" target="_blank">
                                Ver PDF
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('pdf.destroy', $pdf->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este PDF?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
