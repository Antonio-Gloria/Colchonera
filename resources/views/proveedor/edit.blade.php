@extends('adminlte::page')
@section('content')
<div class="container">
   <div class="row">
       <h2>Editar Proveedor</h2>
       <form action="{{ route('proveedors.update', $proveedor->id
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
               <input type="text" class="form-control" id="nombre " name="nombre" value="{{$proveedor->nombre}}" />
           </div>
          <div class="form-group">
               <label for="telefono">Telefono</label>
               <input type="number" class="form-control" id="telefono" name="telefono" value="{{$proveedor->telefono}}" />
           </div>
           <div class="form-group">
               <label for="email">Email</label>
               <input type="text" class="form-control" id="email" name="email" value="{{$proveedor->email}}" />
           </div>
          <div class="form-group">
               <label for="direccion">Dirección</label>
               <input type="text" class="form-control" id="direccion" name="direccion" value="{{$proveedor->direccion}}" />
           </div>
           
           </div>
           <button type="submit" class="btn btn-success">Actualizar proveedor</button>
       </form>
   </div>
</div>
@endsection



