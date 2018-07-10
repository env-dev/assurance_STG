<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAonDecisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('_aon_decision', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::dropIfExists('_aon_decision');
    }
}
