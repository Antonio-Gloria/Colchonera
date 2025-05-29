@extends('adminlte::page')
@section('content')
    <div class="container">
        <div class="row">
            <h2>Agregrar nuevo producto</h2>
        </div>
        <div class="row">

            <form action="{{ route('editoriales.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
                    <input type="text" class="form-control" id="descripcion" name="descripcion">{{ old('descripcion') }}>
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="text" class="form-control" id="precio" name=" Precio" value="{{ old('precio')}}">
                </div>
                <div class="form-group">
                    <label for="tamanio">Tamaño</label>
                    <input type="text" class="form-control" id="tamanio" name="tamanio" value="{{ old('tamanio') }}">
                </div>
                <div class="form-group">
                    <label for="tela">Tela</label>
                    <input type="text" class="form-control" id="tela" name=" Tela"value="{{ old('tela')}}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                </div>

                <button type="submit" class="btn btn-success">Guardar Editorial</button>
            </form>
        </div>
    </div>
@endsection
