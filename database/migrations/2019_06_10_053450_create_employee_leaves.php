<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->bigIncrements('id');
              $table->integer('reference');
            $table->string('id_no');
             $table->integer('type_id');
              $table->string('type');
            $table->string('employee');
             $table->date('leave_from');
             $table->date('leave_to');
            $table->date('return_date');
             $table->string('reason');
             $table->string('status');
               $table->string('comment');
             $table->string('archived');
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
        Schema::dropIfExists('employee_leaves');
    }
}
