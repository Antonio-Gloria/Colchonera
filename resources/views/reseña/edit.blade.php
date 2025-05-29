@extends('adminlte::page')
@section('content')
<div class="container">
   <div class="row">
       <h2>Editar Reseña</h2>
       <form action="{{ route('reseñas.update', $proveedor->id
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
               <label for="comentario">Comentario</label>
               <input type="text" class="form-control" id="comentario" name="comentario" value="{{$reseña->comentario}}" />
           </div>
          <div class="form-group">
               <label for="calificacion">Telefono</label>
               <input type="number" class="form-control" id="calificacion" name="calificacion" value="{{$reseña->calificacion}}" />
           </div>
           </div>
           <button type="submit" class="btn btn-success">Actualizar reseña</button>
       </form>
   </div>
</div>
@endsection



