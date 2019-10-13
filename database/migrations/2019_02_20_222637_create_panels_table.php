<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panels', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('org_id')->nullable();
            $table->unsignedInteger('job_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('circuit_count');
            $table->string('name');
            $table->string('info')->nullable();
            $table->boolean('ab')->nullable();
            $table->mediumText('comment')->nullable();
            $table->unsignedInteger('modified_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('org_id')->references('id')->on('orgs');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panels');
    }
}
