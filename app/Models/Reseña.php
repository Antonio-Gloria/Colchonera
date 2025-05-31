<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseña extends Model
{
    public function producto() //Esto lo agregué para ver si puedo obtener el nombre el tipo de servicio seleccionado
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
