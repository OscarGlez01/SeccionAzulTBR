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
        'facebook',
        'instagram',
        'horarios',
        'estado',
        'imagen',
        'categoria_id'

    ];

    protected $primaryKey = "negocio_id";

    // Se establece la relación entre categoría y negocio (cada negocio cuenta con una categoría)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function subcategorias()
    {
        return $this->belongsToMany(Subcategoria::class, 'negocio_subcategoria','negocio_id', 'subcategoria_id');
    }

    public function getImagenAttribute($value)
    {
        return $value ?: 'thumbnail_negocio.png';
    }

}
