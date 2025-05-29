@extends('adminlte::page')
@section('content')
<div class="container">
   <div class="row">
       <h2>Editar Detalle de la Venta</h2>
       <form action="{{ route('detalleventas.update', $detalleventa->id
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
               <label for="cantidad">Cantidad</label>
               <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{$detalleventa->cantidad}}" />
           </div>
          <div class="form-group">
               <label for="nombre">Precio unitario</label>
               <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" value="{{$detalleventa->precio_unitario}}" />
           </div>
           <button type="submit" class="btn btn-success">Guardar detalle de la venta</button>
       </form>
   </div>
</div>
@endsection



