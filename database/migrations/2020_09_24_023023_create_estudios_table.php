<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->bigInteger('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->decimal('ad');
            $table->decimal('area_ad');
            $table->decimal('ddvd');
            $table->decimal('ddvi');
            $table->decimal('dsvi');
            $table->decimal('fey');
            $table->decimal('fac');
            $table->decimal('siv');
            $table->decimal('ppvi');
            $table->decimal('ai');
            $table->decimal('area_ai');
            $table->decimal('ao');
            $table->decimal('tricuspide_vel');
            $table->decimal('tricuspide_gmax');
            $table->decimal('tricuspide_gmed');
            $table->string('tricuspide_insuficiencia');
            $table->decimal('pulmonar_vel');
            $table->decimal('pulmonar_gmax');
            $table->decimal('pulmonar_gmed');
            $table->string('pulmonar_insuficiencia');
            $table->decimal('mitral_vel');
            $table->decimal('mitral_gmax');
            $table->decimal('mitral_gmed');
            $table->string('mitral_insuficiencia');
            $table->decimal('aortica_vel');
            $table->decimal('aortica_gmax');
            $table->decimal('aortica_gmed');
            $table->string('aortica_insuficiencia');
            $table->string('diametros');
            $table->string('funcion');
            $table->string('espesor');
            $table->string('motilidad');
            $table->string('valvula_mitral');
            $table->string('raiz_aorta');
            $table->string('valvula_aortica');
            $table->string('valvula_pulmonar');
            $table->string('cavidades_derechas');
            $table->string('vci');
            $table->string('pericardio');
            $table->string('masas_intracardiacas');
            $table->string('tabique_interventricular');
            $table->string('patron');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudios');
    }
}
