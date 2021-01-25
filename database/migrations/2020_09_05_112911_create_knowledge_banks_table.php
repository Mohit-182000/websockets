<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowledgeBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_banks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->enum('media_type', array(0, 1, 2))->default(0);
            $table->text('file')->nullable();
            $table->text('link')->nullable();
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
        Schema::dropIfExists('knowledge_banks');
    }
}
