@extends('adminlte::page')
@section('content')
<div class="container">
   <div class="row">
       <h2>Agregrar nueva venta</h2>
</div>
<div class="row">
     
       <form action="{{ route('ventas.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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
               <label for="fecha">Fecha</label>
               <input type="date" class="form-control" id="fecha" name="fecha" value="{{old('fecha')}}" />
           </div>
           <div class="form-group">
               <label for="total">Total</label>
               <input type="number" class="form-control" id="total" name="total" value="{{old('total')}}"/>
           </div>
           <div class="form-group">
               <label for="estado">Estado</label>
               <input type="number" class="form-control" id="estado" name="estado" value="{{old('estado')}}"/>
           </div>           
           <button type="submit" class="btn btn-success">Guardar reseña</button>
       </form>
   </div>
</div>
@endsection

