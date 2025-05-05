<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    //
    protected $table='productos';
    //
    public $timestamps=false;
    
    protected $fillable = [
        'nombre',
        'identificador',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'estado',
        'fecha_registro',
        'actualizar_registro'
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
