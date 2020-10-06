<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudio extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'paciente_id',
        'user_id',
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
        'tricuspide_vel',
        'tricuspide_gmax',
        'tricuspide_gmed',
        'tricuspide_insuficiencia',
        'pulmonar_vel',
        'pulmonar_gmax',
        'pulmonar_gmed',
        'pulmonar_insuficiencia',
        'mitral_vel',
        'mitral_gmax',
        'mitral_gmed',
        'mitral_insuficiencia',
        'aortica_vel',
        'aortica_gmax',
        'aortica_gmed',
        'aortica_insuficiencia',
        'diametros',
        'funcion',
        'espesor',
        'motilidad',
        'valvula_mitral',
        'raiz_aorta',
        'valvula_aortica',
        'valvula_pulmonar',
        'cavidades_derechas',
        'vci',
        'pericardio',
        'masas_intracardiacas',
        'tabique_interventricular',
        'patron',
        'created_at',
        'updated_at'
    ];
}
