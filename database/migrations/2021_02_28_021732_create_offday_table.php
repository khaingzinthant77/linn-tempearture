<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffdayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offday', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->date('off_day_1')->nullable();
            $table->date('off_day_2')->nullable();
            $table->date('off_day_3')->nullable();
            $table->date('off_day_4')->nullable();
            $table->integer('actionBy');
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
        Schema::dropIfExists('offday');
    }
}
