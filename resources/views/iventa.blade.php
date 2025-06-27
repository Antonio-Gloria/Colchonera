<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Ventas</title>
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
<h1>Ventas</h1>

<hr>
<div class="contenido">
  <table>
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">Cliente</th>
       <th scope="col">Fecha</th>
       <th scope="col">Total</th>
       <th scope="col">Estado</th>
     </tr>
   </thead>
   <tbody>
       @foreach($ventas as $key => $venta)
           <tr>
               <td>{{$venta->id}}</td>
               <td>{{$venta->cliente->nombre}}</td>
               <td>{{$venta->fecha}}</td>
               <td>{{$venta->total}}</td>
               <td>{{$venta->estado}}</td>
           </tr>
       @endforeach
   </tbody>
 </table></div>
</body>
</html>
