<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada.
     */
    protected $table = 'dependencias';

    /**
     * Atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'unidad_administradora_id',
        'codigo',
        'nombre',
    ];

    /**
     * Relación: Una dependencia pertenece a una Unidad Administradora.
     */
    public function unidadAdministradora()
    {
        return $this->belongsTo(UnidadAdministradora::class);
    }

    /**
     * Relación: Una dependencia tiene muchos bienes.
     */
    public function bienes()
    {
        return $this->hasMany(Bien::class);
    }
}

