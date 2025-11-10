<?php

namespace App\Models;

use App\Enums\EstadoBien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent model Bien.
 *
 * @property int $id
 */
class Bien extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'bienes';

    // Atributos asignables en masa
    protected $fillable = [
        'dependencia_id',
        'codigo',
        'descripcion',
        'ubicacion',
        'estado',
        'fecha_registro',
    ];

    // App\Models\Bien.php
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('codigo', 'LIKE', "%{$term}%")
                ->orWhere('descripcion', 'LIKE', "%{$term}%")
                ->orWhere('ubicacion', 'LIKE', "%{$term}%");
            });
        }
    }


    // Casts automáticos
    protected $casts = [
        'fecha_registro' => 'datetime',
        'estado' => EstadoBien::class, // Enum PHP 8.1+
    ];

    // Relaciones
    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }


    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
