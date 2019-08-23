<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_attendance', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('reference');
            $table->string('id_no');
             $table->date('date');
            $table->string('employee');
             $table->string('time_in');
             $table->string('time_out');
            $table->string('total_hours');
             $table->string('status_time_in');
             $table->string('status_time_out');
               $table->string('reason');
             $table->string('comment');
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
        Schema::dropIfExists('employee_attendance');
    }
}
