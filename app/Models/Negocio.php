<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    /** @use HasFactory<\Database\Factories\NegocioFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'direccion',
        'ubicacion',
        'telefono',
        'whatsapp',
        'direccion',
        'facebook',
        'instagram',
        'horarios'
        
    ];

    protected $primaryKey = "negocio_id";

    public function subcategorias()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id');
    }

}
