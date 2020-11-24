<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacientes extends Model
{
    use HasFactory;
    protected $table        = 'pacientes';
    protected $primaryKey   = 'id';
    protected $fillable     = [
        'nombre',
        'apellido',
        'dni',
        'tipo_dni',
        'fecha_nacimiento',
        'direccion',
        'provincia',
        'localidad',
        'telefono',
        'celular',
        'email',
        'cobertura',
        'tipo_de_af',
        'cuit',
        'n_af',
        'created_at',
        'updated_at',
    ];
}
