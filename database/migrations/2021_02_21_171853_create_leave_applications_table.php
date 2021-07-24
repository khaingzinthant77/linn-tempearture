<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id');
            $table->integer('leavetype_id');
            $table->boolean('halfDayType')->default(0);
            $table->boolean('halforfull')->default(0);
            $table->integer('last_updated_by');
            $table->date('start_date');
            $table->string('end_date');
            $table->string('days');
            $table->date('apply_date');
            $table->text('reason');
            $table->boolean('application_status')->default(0);
            $table->string('approve_reason')->nullable();
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
        Schema::dropIfExists('leave_applications');
    }
}
