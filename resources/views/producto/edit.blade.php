@extends('adminlte::page')
@section('content')
<div class="container">
   <div class="row">
       <h2>Editar Producto</h2>
       <form action="{{ route('productos.update', $producto->id
) }}" method="post" enctype="multipart/form-data" class="col-lg-7">
           @csrf <!-- Protección contra ataques ya implementado en laravel  https://www.welivesecurity.com/la-es/2015/04/21/vulnerabilidad-cross-site-request-forgery-csrf/-->
           @method('PUT')
           @if($errors->any())
               <div class="alert alert-danger">
                   <ul>
                       @foreach($errors->all() as $error)
                           <li>{{$error}}</li>
                       @endforeach
                   </ul>
               </div>
           @endif
           
           <div class="form-group">
               <label for="nombre">Nombre</label>
               <input type="text" class="form-control" id="nomb" name="nombre" value="{{$producto->nombre}}" />
           </div>
          <div class="form-group">
               <label for="descripcion">Descripcion</label>
               <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$producto->descripcion}}" />
           </div>
           <div class="form-group">
               <label for="precio">Precio</label>
               <input type="number" class="form-control" id="precio" name="precio" value="{{$producto->precio}}" />
           </div>
          <div class="form-group">
               <label for="tamaño">Tamaño</label>
               <input type="text" class="form-control" id="tamaño" name="tamaño" value="{{$producto->tamaño}}" />
           </div>
           <div class="form-group">
               <label for="tela">Tela</label>
               <input type="text" class="form-control" id="tela" name="tela" value="{{$producto->tela}}" />
           </div>
          <div class="form-group">
               <label for="stock">Stock</label>
               <input type="text" class="form-control" id="stock" name="stock" value="{{$producto->stock}}" />
           </div>
           <div class="form-group mb-3">
                    <label for="categoria_id">Categoría</label>
                    <select class="form-control" id="categoria_id" name="categoria_id" required>
                        <option value="" disabled>Selecciona una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="proveedor_id">Proveedor</label>
                    <select class="form-control" id="proveedor_id" name="proveedor_id" required>
                        <option value="" disabled>Selecciona un proveedor</option>
                        @foreach ($proveedors as $proveedor)
                            <option value="{{ $proveedor->id }}" {{ old('proveedor_id', $producto->proveedor_id) == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                    @error('proveedor_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
           <button type="submit" class="btn btn-success">Actualizar producto</button>
       </form>
   </div>
</div>
@endsection



