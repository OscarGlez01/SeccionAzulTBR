<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    /** @use HasFactory<\Database\Factories\SubcategoriaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id'
    ];

    protected $primaryKey = "subcategoria_id";

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id')->withDefault();
    }

}