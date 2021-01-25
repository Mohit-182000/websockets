<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobpostShift extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_job_post', function (Blueprint $table) {
            $table->unsignedBigInteger('job_post_id');
            $table->unsignedBigInteger('shift_id');

            $table->foreign('job_post_id')->references('id')->on('job_post');            
            $table->foreign('shift_id')->references('id')->on('shifts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shift_job_post');
    }
}
