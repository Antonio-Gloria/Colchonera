<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    public function cliente() //Esto lo agregué para ver si puedo obtener el nombre el tipo de servicio seleccionado
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }


}
