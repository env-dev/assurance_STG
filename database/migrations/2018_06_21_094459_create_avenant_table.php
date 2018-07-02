<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mandat_num')->unique();
            $table->integer('extension_added');
            $table->date('effective_date');
            $table->decimal('add_premium', 6, 2);
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
        Schema::dropIfExists('avenants');
    }
}
