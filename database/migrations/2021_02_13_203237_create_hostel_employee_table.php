<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_employee', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->integer('hostel_id');
            $table->integer('room_id');
            $table->string('start_date');
            $table->string('full_address');
            $table->string('name');
            $table->string('branch_id');
            $table->string('dep_id');
            $table->string('position_id');
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
        Schema::dropIfExists('hostel_employee');
    }
}
