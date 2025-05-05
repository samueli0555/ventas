<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table='categoria';
    //
    public $timestamps=false;
    protected $fillable = [
        'nombre',
        'identificador',
        'fecha_registro',
        'actualizar_registro'
    ];

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }
}
