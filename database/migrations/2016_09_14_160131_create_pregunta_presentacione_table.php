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
           $table->integer('preguntas_id')->unsigned();
            $table->integer('presentacione_id')->unsigned();
            $table->string('respuesta');
            $table->timestamps();

            $table->foreign('preguntas_id')
                  ->references('id')->on('preguntas')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

            $table->foreign('presentacione_id')
                  ->references('id')->on('presentaciones')
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
        Schema::dropIfExists('pregunta_presentacione');
    }
}
