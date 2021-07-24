<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCvformTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cvform', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nrc_code');
            $table->string('nrc_state');
            $table->string('nrc_status');
            $table->string('nrc');
            $table->string('fullnrc');
            $table->string('dob');
            $table->string('edu');
            $table->string('religion');
            $table->string('gender');
            $table->string('marrical_status');
            $table->string('email');
            $table->string('fName');
            $table->string('fPhone');
            $table->string('experience');
            $table->string('job');
            $table->string('department');
            $table->string('exp_salary');
            $table->string('hostel');
            $table->string('applied_date');
            $table->string('address');
            $table->string('phone');
            $table->string('photo');
            $table->string('signature');
            $table->integer('status')->default(0);
            $table->string('city');
            $table->string('township');
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
            $table->string('first_date')->nullable();;
            $table->string('second_date')->nullable();;
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
        Schema::dropIfExists('cvform');
    }
}
