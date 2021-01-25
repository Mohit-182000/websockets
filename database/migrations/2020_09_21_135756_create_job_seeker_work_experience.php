<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekerWorkExperience extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seeker_work_experience', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('position')->nullable();
            $table->longText('where_did_you_work')->nullable();
            $table->longText('address')->nullable();
            $table->string('start_date')->nullable();
            $table->string('current_work_here')->nullable();
            $table->string('end_date')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_seeker_work_experience');
    }
}
