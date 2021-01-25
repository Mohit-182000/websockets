<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobpostCareerLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_level_job_post', function (Blueprint $table) {
            $table->unsignedBigInteger('job_post_id');
            $table->unsignedBigInteger('career_level_id');

            $table->foreign('job_post_id')->references('id')->on('job_post');            
            $table->foreign('career_level_id')->references('id')->on('career_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_level_job_post');
    }
}
