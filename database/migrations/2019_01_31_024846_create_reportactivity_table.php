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
            $table->integer('project_id')->unsigned()->index()->nullable();            
            $table->foreign('project_id')->references('id')->on('projects');            
            $table->integer('report_id')->unsigned()->index()->nullable();
            $table->foreign('report_id')->references('id')->on('reports');
            $table->string('module');
            $table->string('activity');
            $table->integer('priority')->unsigned()->index()->nullable();
            $table->foreign('priority')->references('id')->on('md_priority');
            $table->integer('status')->unsigned()->index()->nullable();
            $table->foreign('status')->references('id')->on('md_status');
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
