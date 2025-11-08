<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadAdministradora extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada.
     * Especificado porque el plural es irregular.
     */
    protected $table = 'unidades_administradoras';

    /**
     * Atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'organismo_id',
        'codigo',
        'nombre',
    ];

    /**
     * Relación: Una Unidad Administradora pertenece a un Organismo.
     */
    public function organismo()
    {
        return $this->belongsTo(Organismo::class);
    }

    /**
     * Relación: Una Unidad Administradora tiene muchas Dependencias.
     */
    public function dependencias()
    {
        return $this->hasMany(Dependencia::class);
    }
}

