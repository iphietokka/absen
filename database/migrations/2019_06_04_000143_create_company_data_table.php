<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference');
            $table->string('company');
            $table->string('department');
            $table->string('job_position');
            $table->string('company_email')->unique();
            $table->string('id_no');
            $table->string('start_date');
            $table->text('date_regularized');
             $table->string('reason');
            $table->string('leave_privilege');
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
        Schema::dropIfExists('company_data');
    }
}
