<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JobPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_post', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->longText('job_description');
            $table->string('location');
            $table->string('vacancy');
            $table->string('gender');
            $table->bigInteger('experience_id')->unsigned();
            $table->bigInteger('career_level_id')->unsigned();
            $table->bigInteger('shift_id')->unsigned();
            $table->bigInteger('marital_status_id')->unsigned();
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('city_id')->unsigned();
            $table->string('minimum_salary')->nullable(); 
            $table->string('maximum_salary')->nullable(); 
            $table->string('is_active')->nullable(); 
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->foreign('career_level_id')->references('id')->on('career_levels')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_post');
    }
}
