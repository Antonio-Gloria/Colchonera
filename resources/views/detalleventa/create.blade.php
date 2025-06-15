@extends('adminlte::page')
@section('content')
<div class="container">
   <div class="row">
       <h2>Agregrar detalle venta</h2>
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
           <div class="form-group mb-3">
            <label for="venta_id" class="form-label">Venta</label>
            <select class="form-control" id="venta_id" name="venta_id" required>
                <option value="" disabled selected>Selecciona una venta</option>
                @foreach ($ventas as $venta)
                <option value="{{ $venta->id}}">{{$venta->id}}</option>
                @endforeach
            </select>
           </div>
           <div class="form-group mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select class="form-control" id="producto_id" name="producto_id" required>
                <option value="" disabled selected>Selecciona una producto</option>
                @foreach ($productos as $producto)
                <option value="{{ $producto->id}}">{{$producto->nombre}}</option>
                @endforeach
            </select>
           </div>
           <div class="form-group">
               <label for="cantidad">Cantidad</label>
               <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{old('cantidad')}}" />
           </div>
           <div class="form-group">
               <label for="precio_unitario">Precio unitario</label>
               <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" value="{{old('precio_unitario')}}"/>
           </div>         
           <button type="submit" class="btn btn-success">Guardar detalle de venta</button>
       </form>
   </div>
</div>
@endsection




