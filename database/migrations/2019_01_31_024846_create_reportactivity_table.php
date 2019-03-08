<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportactivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportactivity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');            
            $table->integer('report_id');
            $table->string('module');
            $table->string('activity');
            $table->integer('priority');
            $table->integer('status');
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
        Schema::dropIfExists('reportactivity');
    }
}
