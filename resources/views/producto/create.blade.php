@extends('adminlte::page')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Agregrar nuevo producto</h2>
        </div>
        <div class="row">

            <form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
                @csrf
                <!-- Protección contra ataques ya implementado en laravel  https://www.welivesecurity.com/la-es/2015/04/21/vulnerabilidad-cross-site-request-forgery-csrf/-->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" />
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                        value="{{ old('descripcion') }}" />
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" class="form-control" id="precio" name="precio" value="{{ old('precio') }}">
                </div>

                <div class="form-group">
                    <label for="tamaño">Tamaño</label>
                    <select class="form-control" id="tamaño" name="tamaño">
                        <option value="1" {{ old('tamaño') == '1' ? 'selected' : '' }}>Individual</option>
                        <option value="2" {{ old('tamaño') == '2' ? 'selected' : '' }}>Matrimonial</option>
                        <option value="3" {{ old('tamaño') == '3' ? 'selected' : '' }}>Queen Size</option>
                        <option value="4" {{ old('tamaño') == '4' ? 'selected' : '' }}>King Size</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tela">Tela</label>
                    <input type="text" class="form-control" id="tela" name="tela"value="{{ old('tela') }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="categoria_id" class="form-label">Categoria</label>
                    <select class="form-control" id="categoria_id" name="categoria_id" required>
                        <option value="" disabled selected>Selecciona el tipo de categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="proveedor_id" class="form-label">Proveedor</label>
                    <select class="form-control" id="proveedor_id" name="proveedor_id" required>
                        <option value="" disabled selected>Selecciona el tipo de servicio</option>
                        @foreach ($proveedors as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar Producto</button>
            </form>
        </div>
    </div>
@endsection
