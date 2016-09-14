<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecentacionePreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precentacione_pregunta', function (Blueprint $table) {
            $table->integer('preguntas_id')->unsigned();
            $table->integer('precentacione_id')->unsigned();
            $table->string('respuesta');
            $table->timestamps();

            $table->foreign('preguntas_id')
                  ->references('id')->on('preguntas')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

            $table->foreign('precentacione_id')
                  ->references('id')->on('precentaciones')
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
        Schema::dropIfExists('precentacione_pregunta');
    }
}
