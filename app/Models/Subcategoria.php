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
    // Relación entre negocios y sub-categorias o etiquetas ( Un negocio puede contar con multiples subcategorias, las cuales a su vez estan relacionadas a una categoria y a otros negocios.)
    public function negocios()
    {
        return $this->belongsToMany(Negocio::class, 'negocio_subcategoria', 'subcategoria_id', 'negocio_id');
    }

}
