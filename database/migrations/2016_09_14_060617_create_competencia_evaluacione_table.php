<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetenciaEvaluacioneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competencia_evaluacione', function (Blueprint $table) {
            $table->integer('competencia_id')->unsigned();
            $table->integer('evaluacione_id')->unsigned();

            $table->foreign('competencia_id')
                  ->references('id')->on('competencias')
                  ->onUpdate('no action')
                  ->onDelete('restrict');

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
        Schema::dropIfExists('competencia_evaluacione');
    }
}
