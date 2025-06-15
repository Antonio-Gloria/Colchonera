@extends('adminlte::page')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Editar Venta</h2>
            <form action="{{ route('ventas.update', $venta->id) }}" method="post" enctype="multipart/form-data"
                class="col-lg-7">
                @csrf
                <!-- Protección contra ataques ya implementado en laravel  https://www.welivesecurity.com/la-es/2015/04/21/vulnerabilidad-cross-site-request-forgery-csrf/-->
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label for="cliente_id">Cliente</label>
                    <select class="form-control" id="cliente_id" name="cliente_id" required>
                        <option value="" disabled>Selecciona una cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}"
                                {{ old('cliente_id', $venta->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $venta->fecha }}" />
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" class="form-control" id="total" name="total" value="{{ $venta->total }}" />
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="{{ $venta->estado }}" />
                </div>
        </div>
        <button type="submit" class="btn btn-success">Actualizar venta</button>
        </form>
    </div>
    </div>
@endsection
