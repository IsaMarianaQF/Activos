<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $fillable = [
        'sys', 'atn', 'nombre', 'marca', 'modelo', 'serial', 'codactivo', 'estado', 'usuario', 'area', 'sucursal', 'ciudad', 'observacion',
    ];

    public function historiales()
{
    return $this->hasMany(Historial::class, 'activo_id')->orderBy('created_at', 'desc');
}

}

