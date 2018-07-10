<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReparationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_flow');
            $table->date('date_reparation');
            $table->string('price_ttc_reparation');
            $table->string('price_ttc_replacement');
            $table->string('price_ttc_workforce');
            $table->UnsignedInteger('sinister_id');
            $table->timestamps();
            
            $table->softDeletes();

            
            $table->foreign('sinister_id')
                    ->references('id')->on('sinisters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparation');
    }
}
