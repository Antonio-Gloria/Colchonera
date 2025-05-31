@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-7">
            <h2>Editar Reseña</h2>
            <form action="{{ route('reseñas.update', $reseña->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="comentario">Comentario</label>
                    <textarea class="form-control" id="comentario" name="comentario" rows="5" required>{{ $reseña->comentario }}</textarea>
                    @error('comentario')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="calificacion">Calificación</label>
                    <input type="number" class="form-control" id="calificacion" name="calificacion" value="{{ $reseña->calificacion }}" min="1" max="5" required />
                    @error('calificacion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="producto_id">Producto</label>
                    <select class="form-control" id="producto_id" name="producto_id" required>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ $reseña->producto_id == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                    @error('producto_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    <select class="form-control" id="cliente_id" name="cliente_id" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $reseña->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                        @endforeach
                    </select>
                    @error('cliente_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Actualizar Reseña</button>
            </form>
        </div>
    </div>
</div>
@endsection