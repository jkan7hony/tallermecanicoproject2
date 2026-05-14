<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'marca',
        'modelo',
        'anio',
        'patente',
    ];

    public function ordenTrabajos()
    {
        return $this->hasMany(OrdenTrabajo::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
