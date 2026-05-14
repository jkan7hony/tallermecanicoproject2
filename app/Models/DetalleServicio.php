<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetalleServicio extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'orden_trabajo_id',
        'repuesto_id',
        'nombre',
        'marca',
        'stock',
    ];

    public function ordenTrabajo()
    {
        return $this->belongsTo(OrdenTrabajo::class);
    }

    public function repuesto()
    {
        return $this->belongsTo(Repuesto::class);
    }

    protected static function booted()
    {
        // Al crear: restar stock del repuesto seleccionado
        static::created(function (DetalleServicio $detalle) {
            DB::transaction(function () use ($detalle) {
                $repuesto = $detalle->repuesto()->lockForUpdate()->first();
                if (! $repuesto) {
                    return;
                }
                $qty = (int) $detalle->stock;
                $repuesto->stock = max(0, $repuesto->stock - $qty);
                $repuesto->save();
            });
        });

        // Al actualizar: ajustar según la diferencia y/o cambio de repuesto
        static::updated(function (DetalleServicio $detalle) {
            DB::transaction(function () use ($detalle) {
                $original = $detalle->getOriginal();
                $oldQty = (int) ($original['stock'] ?? 0);
                $newQty = (int) $detalle->stock;
                $oldRepuestoId = $original['repuesto_id'] ?? null;
                $newRepuestoId = $detalle->repuesto_id;

                // Si cambió el repuesto, devolver stock al repuesto antiguo
                if ($oldRepuestoId && $oldRepuestoId != $newRepuestoId) {
                    $oldRepuesto = Repuesto::lockForUpdate()->find($oldRepuestoId);
                    if ($oldRepuesto) {
                        $oldRepuesto->stock = $oldRepuesto->stock + $oldQty;
                        $oldRepuesto->save();
                    }
                }

                // Ajustar el repuesto nuevo/restante según diferencia
                if ($newRepuestoId) {
                    $repuesto = Repuesto::lockForUpdate()->find($newRepuestoId);
                    if ($repuesto) {
                        // Si el repuesto no cambió, restar la diferencia (new - old)
                        if ($oldRepuestoId == $newRepuestoId) {
                            $diff = $newQty - $oldQty; // positivo => usar más (restar más)
                            $repuesto->stock = max(0, $repuesto->stock - $diff);
                        } else {
                            // repuesto cambió: restar la nueva cantidad del repuesto nuevo
                            $repuesto->stock = max(0, $repuesto->stock - $newQty);
                        }
                        $repuesto->save();
                    }
                }
            });
        });

        // Al eliminar: devolver la cantidad usada al stock del repuesto
        static::deleted(function (DetalleServicio $detalle) {
            DB::transaction(function () use ($detalle) {
                $repuesto = Repuesto::lockForUpdate()->find($detalle->repuesto_id);
                if (! $repuesto) {
                    return;
                }
                $repuesto->stock = $repuesto->stock + (int) $detalle->stock;
                $repuesto->save();
            });
        });
    }
}
