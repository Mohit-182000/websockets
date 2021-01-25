<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('no_of_post');
            $table->integer('fees');
            $table->string('age_limit');
            $table->date('exam_date');
            $table->date('last_date_of_exam');
            $table->string('link');
            $table->text('description');
            $table->enum('is_active', array('Yes', 'No'))->default('Yes');
            $table->integer('added_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('exam_updates');
    }
}
