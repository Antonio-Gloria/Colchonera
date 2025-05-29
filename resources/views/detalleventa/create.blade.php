@extends('adminlte::page')
@section('content')
<div class="container">
   <div class="row">
       <h2>Detalle de venta</h2>
</div>
<div class="row">
     
       <form action="{{ route('detalleventas.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
           @csrf <!-- Protección contra ataques ya implementado en laravel  https://www.welivesecurity.com/la-es/2015/04/21/vulnerabilidad-cross-site-request-forgery-csrf/-->
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
               <label for="cantidad">Cantidad</label>
               <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{old('cantidad')}}" />
           </div>
          <div class="form-group">
               <label for="precio_unitario">Precio unitario</label>
               <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" value="{{old('precio_unitario')}}" />
           </div>x
           <button type="submit" class="btn btn-success">Guardar Categoria</button>
       </form>
   </div>
</div>
@endsection


