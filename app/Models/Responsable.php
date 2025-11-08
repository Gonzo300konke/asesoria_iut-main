<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = 'responsables';
    public $timestamps = false;

    protected $fillable = ['tipo_id', 'cedula', 'nombre', 'correo', 'telefono'];

    public function tipo()
    {
        return $this->belongsTo(TipoResponsable::class, 'tipo_id');
    }

    public function bienes()
    {
        return $this->hasMany(Bien::class);
    }
}
