<?php

namespace App\Models;

use App\Enums\EstadoBien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bien extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'bienes';

    // Atributos asignables en masa
    protected $fillable = [
        'dependencia_id',
        'responsable_id',
        'codigo',
        'descripcion',
        'ubicacion',
        'estado',
        'fecha_registro',
    ];

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

    public function responsable()
    {
        return $this->belongsTo(Responsable::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}

