<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Producto</title>
    <style>
        h1 {
            text-align: center;
            text-transform: uppercase;
        }

        .contenido {
            font-size: 20px;
        }

        #primero {
            background-color: #ccc;
        }

        #segundo {
            color: #44a359;
        }

        #tercero {
            text-decoration: line-through;
        }
    </style>


</head>

<body>
    <h1>Productos</h1>

    <hr>
    <div class="contenido">
        <table>
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Tamaño</th>
                    <th scope="col">Tela</th>
                    <th acope="col">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $key => $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->tamaño }}</td>
                        <td>{{ $producto->tela }}</td>
                        <td>{{ $producto->Stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
