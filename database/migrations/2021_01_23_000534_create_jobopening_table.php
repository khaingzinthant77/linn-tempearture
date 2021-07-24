<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobopeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobopening', function (Blueprint $table) {
            $table->id();
            $table->integer('dep_id');
            $table->integer('position_id');
            $table->string('title');
            $table->string('description');
            $table->string('posted_date');
            $table->string('last_date');
            $table->string('close_date');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobopening');
    }
}
