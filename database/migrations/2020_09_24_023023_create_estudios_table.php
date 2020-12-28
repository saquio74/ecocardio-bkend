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
            $table->bigInteger('paciente_id')->references('id')->unsigned()->on('pacientes')->onDelete('cascade');
            $table->bigInteger('user_id')->references('id')->unsigned()->on('user')->onDelete('cascade');
            $table->string('medico_solicitante')->nullable();
            $table->string('diagnostico')->nullable();
            $table->double('peso')->nullable();
            $table->double('altura')->nullable();
            $table->decimal('ad')->nullable();
            $table->decimal('area_ad')->nullable();
            $table->decimal('ddvd')->nullable();
            $table->decimal('ddvi')->nullable();
            $table->decimal('dsvi')->nullable();
            $table->decimal('fey')->nullable();
            $table->decimal('fac')->nullable();
            $table->decimal('siv')->nullable();
            $table->decimal('ppvi')->nullable();
            $table->decimal('ai')->nullable();
            $table->decimal('area_ai')->nullable();
            $table->decimal('ao')->nullable();
            $table->double('tricuspide_e')->nullable();
            $table->double('tricuspide_a')->nullable();
            $table->double('tricuspide_gmax')->nullable();
            $table->double('tricuspide_gmed')->nullable();
            $table->string('tricuspide_insuficiencia')->nullable();
            $table->double('pulmonar_vel')->nullable();
            $table->double('pulmonar_gmax')->nullable();
            $table->double('pulmonar_gmed')->nullable();
            $table->string('pulmonar_insuficiencia')->nullable();
            $table->double('mitral_e')->nullable();
            $table->double('mitral_a')->nullable();
            $table->double('mitral_gmax')->nullable();
            $table->double('mitral_gmed')->nullable();
            $table->string('mitral_insuficiencia')->nullable();
            $table->double('aortica_vel')->nullable();
            $table->double('aortica_gmax')->nullable();
            $table->double('aortica_gmed')->nullable();
            $table->string('aortica_insuficiencia')->nullable();
            $table->string('diametros');
            $table->string('auricula_izquierda');
            $table->string('cavidades_derechas');
            $table->string('funcion');
            $table->string('espesor');
            $table->string('motilidad');
            $table->string('valvula_mitral');
            $table->string('raiz_aorta');
            $table->string('valvula_aortica');
            $table->string('valvula_tricuspide');
            $table->string('valvula_pulmonar');
            $table->string('pericardio_masas');
            $table->string('vci');
            $table->string('tabiques');
            $table->string('patron');
            $table->string('valvulopatias');
            $table->string('conclusion');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
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
