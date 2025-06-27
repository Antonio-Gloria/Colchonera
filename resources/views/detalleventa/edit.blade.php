@extends('adminlte::page')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Editar Detalle de Venta</h2>
            <form action="{{ route('detalleventas.update', $detalleventa->id) }}" method="post" enctype="multipart/form-data"
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
                    <label for="venta_id">Id Cliente</label>
                    <select class="form-control" id="venta_id" name="venta_id" required>
                        <option value="" disabled>Selecciona una venta</option>
                        @foreach ($ventas as $venta)
                            <option value="{{ $venta->id }}"
                                {{ old('venta_id', $detalleventa->venta_id) == $venta->id ? 'selected' : '' }}>
                                {{ $venta->cliente_id }}</option>
                        @endforeach
                    </select>
                    @error('venta_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="producto_id">Producto</label>
                    <select class="form-control" id="producto_id" name="producto_id" required>
                        <option value="" disabled>Selecciona un Producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}"
                                {{ old('producto_id', $detalleventa->producto_id) ==$producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }}</option>
                        @endforeach
                    </select>

                    @error('producto_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $detalleventa->cantidad }}" />
                </div>
                <div class="form-group">
                    <label for="precio_unitario">Precio unitario</label>
                    <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" value="{{ $detalleventa->precio_unitario }}" />
                </div>

        </div>
        <button type="submit" class="btn btn-success">Actualizar venta</button>
        </form>
    </div>
    </div>
@endsection
