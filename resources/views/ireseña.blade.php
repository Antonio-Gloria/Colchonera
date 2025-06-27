<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Reseñas</title>
   <style>
       h1{
           text-align: center;
           text-transform: uppercase;
       }
       .contenido{
           font-size: 20px;
       }
       #primero{
           background-color: #ccc;
       }
       #segundo{
           color:#44a359;
       }
       #tercero{
           text-decoration:line-through;
       }
   </style>
 

</head>
<body>
<h1>Reseñas</h1>

<hr>
<div class="contenido">
  <table>
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">Producto</th>
       <th scope="col">Cliente</th>
       <th scope="col">Comentario</th>
       <th scope="col">Calificación</th>
     </tr>
   </thead>
   <tbody>
       @foreach($reseñas as $key => $reseña)
           <tr>
               <td>{{$reseña->id}}</td>
               <td>{{$reseña->cliente->nombre}}</td>
               <td>{{$reseña->producto->nombre}}</td>
               <td>{{$reseña->comentario}}</td>
               <td>{{$reseña->calificacion}}</td>
           </tr>
       @endforeach
   </tbody>
 </table></div>
</body>
</html>
