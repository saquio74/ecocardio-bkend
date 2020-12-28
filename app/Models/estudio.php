<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudio extends Model
{
    use HasFactory;
    protected $table = 'estudios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'paciente_id',
        'user_id',
        'medico_solicitante',
        'diagnostico',
        'peso',
        'altura',
        'ad',
        'area_ad',
        'ddvd',
        'ddvi',
        'dsvi',
        'fey',
        'fac',
        'siv',
        'ppvi',
        'ai',
        'area_ai',
        'ao',
        'tricuspide_e',
        'tricuspide_a',
        'tricuspide_gmax',
        'tricuspide_gmed',
        'tricuspide_insuficiencia',
        'pulmonar_vel',
        'pulmonar_gmax',
        'pulmonar_gmed',
        'pulmonar_insuficiencia',
        'mitral_e',
        'mitral_a',
        'mitral_gmax',
        'mitral_gmed',
        'mitral_insuficiencia',
        'aortica_vel',
        'aortica_gmax',
        'aortica_gmed',
        'aortica_insuficiencia',
        'diametros',
        'auricula_izquierda',
        'cavidades_derechas',
        'funcion',
        'espesor',
        'motilidad',
        'valvula_mitral',
        'raiz_aorta',
        'valvula_aortica',
        'valvula_tricuspide',
        'valvula_pulmonar',
        'pericardio_masas',
        'vci',
        'tabiques',
        'patron',
        'valvulopatias',
        'conclusion',
        'created_at',
        'updated_at'
    ];
}
