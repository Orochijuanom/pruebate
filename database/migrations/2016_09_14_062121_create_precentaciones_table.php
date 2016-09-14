<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecentacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precentaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('evaluacione_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::dropIfExists('precentaciones');
    }
}
