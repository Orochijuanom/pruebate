<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evaluacione_id')->unsigned();
            $table->string('descripcion');
            $table->string('opa');
            $table->string('opb');
            $table->string('opc');
            $table->string('opd');
            $table->string('respuesta');
            $table->timestamps();

            $table->foreign('evaluacione_id')
                  ->references('id')->on('evaluaciones')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preguntas');
    }
}
