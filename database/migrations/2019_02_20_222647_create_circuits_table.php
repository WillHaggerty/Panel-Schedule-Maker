<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circuits', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('org_id')->nullable();
            $table->unsignedInteger('job_id');
            $table->unsignedInteger('panel_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('circuit_num');
            $table->boolean('ab')->nullable();
            $table->string('name');
            $table->unsignedInteger('poles')->default(1);
            $table->unsignedInteger('modified_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('org_id')->references('id')->on('orgs');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('panel_id')->references('id')->on('panels')->onDelete('cascade');
          });
          // Schema::table('circuits', function ($table) {
          // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('circuits');
    }
}
