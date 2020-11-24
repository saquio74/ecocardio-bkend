<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('tipo_dni')->after('dni');
            $table->string('n_af')->after('fecha_nacimiento');
            $table->string('cuit')->after('fecha_nacimiento')->unique();
            $table->string('tipo_de_af')->after('fecha_nacimiento');
            $table->string('cobertura')->after('fecha_nacimiento');
            $table->string('email')->after('fecha_nacimiento');
            $table->string('celular')->after('fecha_nacimiento');
            $table->string('telefono')->after('fecha_nacimiento');
            $table->string('localidad')->after('fecha_nacimiento');
            $table->string('direccion')->after('fecha_nacimiento');
            $table->string('provincia')->after('fecha_nacimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            //
        });
    }
}
