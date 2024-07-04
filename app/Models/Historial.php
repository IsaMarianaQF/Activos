<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $fillable = [
        'activo_id',
        'cambios', // Aquí deberías tener los campos modificados y los valores anteriores y nuevos
    ];

    // Relación con el activo
    public function activo()
    {
        return $this->belongsTo(Activo::class);
    }
}
