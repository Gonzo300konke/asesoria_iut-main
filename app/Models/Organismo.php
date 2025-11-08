<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    use HasFactory;

    protected $table = 'organismos';

    protected $fillable = [
        'codigo',
        'nombre',
    ];

    /**
     * Un organismo tiene muchas Unidades Administradoras.
     */
    public function unidadesAdministradoras()
    {
        return $this->hasMany(UnidadAdministradora::class);
    }
}
