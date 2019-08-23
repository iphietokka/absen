<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
                 $table->integer('reference');
            $table->string('id_no');
            $table->string('employee');
             $table->text('in_time');
             $table->text('out_time');
            $table->date('date_from');
             $table->date('date_to');
             $table->integer('hours');
               $table->string('restday');
             $table->integer('archive');
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
        Schema::dropIfExists('employee_schedules');
    }
}
