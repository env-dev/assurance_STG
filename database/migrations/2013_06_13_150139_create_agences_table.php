<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('name');
            $table->string('reference');
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->integer('city_id')->unsigned();
            $table->timestamps();

            $table->foreign('city_id')
                        ->references('id')->on('cities');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agences');
    }
}
