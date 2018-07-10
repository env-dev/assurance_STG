<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinisters', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_flow');
            $table->date('date_sinister');
            $table->string('place_sinister');
            $table->string('cause_sinister');
            $table->string('aon_decision')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('type_sinister');
            $table->integer('registration_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign('registration_id')
                    ->references('id')->on('registrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sinisters');
    }
}
