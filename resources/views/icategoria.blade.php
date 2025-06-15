<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <title>Categorias</title>
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
<h1>Categorias</h1>

<hr>
<div class="contenido">
  <table>
   <thead>
     <tr>
       <th scope="col">#</th>
       <th scope="col">Nombre</th>
     </tr>
   </thead>
   <tbody>
       @foreach($categorias as $key => $categoria)
           <tr>
               <td>{{$categoria->id}}</td>
               <td>{{$categoria->nombre}}</td>
           </tr>
       @endforeach
   </tbody>
 </table></div>
</body>
</html>
