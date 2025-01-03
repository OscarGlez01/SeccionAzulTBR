<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'banner',
        'logo'
    ];

    protected $primaryKey = "categoria_id";

    public function subcategories()
    {
        return $this->hasMany(Subcategoria::class, 'categoria_id');
    }

    public function getBannerAttribute($value)
    {
        return $value ?: '/placeholders/thumbnail_negocio.png';
    }

}
