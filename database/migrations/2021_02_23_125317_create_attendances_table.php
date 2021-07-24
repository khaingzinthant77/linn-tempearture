<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->date('date');
            $table->date('out_date');
            $table->boolean('attendance_status')->default(1);
            $table->string('clockin_ip_address')->nullable();
            $table->string('colckout_ip_address')->nullable();
            $table->string('working_from')->nullable();
            $table->string('note')->nullable();
            $table->boolean('is_late')->default(0);
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
        Schema::dropIfExists('attendances');
    }
}
