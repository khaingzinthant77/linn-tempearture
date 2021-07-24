<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('user_id');
            $table->integer('dep_id');
            $table->integer('position_id');
            $table->string('name');
            $table->string('gender');
            $table->string('marrical_status');
            $table->string('father_name');
            $table->string('phone_no');
            $table->string('nrc_code');
            $table->string('nrc_state');
            $table->string('nrc_status');
            $table->string('nrc');
            $table->string('fullnrc');
            $table->string('date_of_birth');
            $table->string('join_date');
            $table->string('join_month');
            $table->string('address');
            $table->string('city');
            $table->string('township');
            $table->string('qualification');
            $table->string('salary')->nullable();
            $table->string('photo');
            $table->string('race');
            $table->string('religion');
            $table->string('email');
            $table->string('fPhone');
            $table->string('experience');
            $table->string('exp_salary');
            $table->string('hostel');
            $table->string('graduation');
            $table->string('degree');
            $table->string('level');
            $table->string('course_title');
            $table->string('exp_company');
            $table->string('exp_position');
            $table->string('exp_location');
            $table->string('exp_date_from');
            $table->string('exp_date_to');
            $table->string('skills');
            $table->string('proficiency');
            $table->string('police_reco');
            $table->string('ward_reco');
            $table->string('cvfile');
            $table->string('otherfile');
            $table->string('hostel_location');
            $table->string('room_no');
            $table->string('home_no');
            $table->string('hostel_sdate');
            $table->string('active')->default('0');
            $table->string('employment_type');
            $table->string('noti_token')->nullable();
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
        Schema::dropIfExists('employee');
    }
}
