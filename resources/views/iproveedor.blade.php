<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Proveedores</title>
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
<h1>Proveedores</h1>

<hr>
<div class="contenido">
  <table>
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">Nombre</th>
       <th scope="col">Telefono</th>
       <th scope="col">Email</th>
       <th scope="col">Dirección</th>
     </tr>
   </thead>
   <tbody>
       @foreach($proveedores as $key => $proveedor)
           <tr>
               <td>{{$proveedor->id}}</td>
               <td>{{$proveedor->nombre}}</td>
               <td>{{$proveedor->telefono}}</td>
               <td>{{$proveedor->email}}</td>
               <td>{{$proveedor->direccion}}</td>
           </tr>
       @endforeach
   </tbody>
 </table></div>
</body>
</html>
