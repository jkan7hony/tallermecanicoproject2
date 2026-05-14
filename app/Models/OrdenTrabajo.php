<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo_id',
        'fecha_ingreso',
        'fecha_salida',
        'estado',
        'descripcion_problema',
        'costo_estimado',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function detalleServicios()
    {
        return $this->hasMany(DetalleServicio::class);
    }
}
