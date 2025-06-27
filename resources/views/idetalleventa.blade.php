<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Detalle de Venta</title>
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
<h1>Detalle de Venta</h1>

<hr>
<div class="contenido">
  <table>
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">Id venta</th>
       <th scope="col">Nombre del Producto</th>
       <th scope="col">Cantidad</th>
       <th scope="col">Precio Unitario</th>
     </tr>
   </thead>
   <tbody>
       @foreach($detalleventas as $key => $detalleventa)
           <tr>
               <td>{{$detalleventa->id}}</td>
               <td>{{$detalleventa->venta->id}}</td>
               <td>{{$detalleventa->producto->nombre}}</td>
               <td>{{$detalleventa->cantidad}}</td>
               <td>{{$detalleventa->precio_unitario}}</td>
           </tr>
       @endforeach
   </tbody>
 </table></div>
</body>
</html>
