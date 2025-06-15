<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Cliente</title>
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
<h1>Clientes</h1>

<hr>
<div class="contenido">
  <table>
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">Nombre</th>
       <th scope="col">Email</th>
       <th scope="col">Password</th>
        <th scope="col">Dirección</th>
       <th scope="col">Telefono</th>
     </tr>
   </thead>
   <tbody>
       @foreach($clientes as $key => $cliente)
           <tr>
               <td>{{$cliente->id}}</td>
               <td>{{$cliente->nombre}}</td>
               <td>{{$cliente->email}}</td>
               <td>{{$cliente->password}}</td>
               <td>{{$cliente->direccion}}</td>
               <td>{{$cliente->telefono}}</td>
           </tr>
       @endforeach
   </tbody>
 </table></div>
</body>
</html>
