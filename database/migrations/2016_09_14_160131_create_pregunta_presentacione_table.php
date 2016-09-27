<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntaPresentacioneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_presentacione', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pregunta_id')->unsigned();
            $table->integer('presentacione_id')->unsigned();
            $table->string('respuesta');
            $table->timestamps();

            $table->foreign('pregunta_id')
                  ->references('id')->on('preguntas')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

            $table->foreign('presentacione_id')
                  ->references('id')->on('presentaciones')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

            $table->unique(['pregunta_id', 'presentacione_id'], 'respuesta_unica_por_intento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregunta_presentacione');
    }
}
