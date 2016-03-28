<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('personal_detail_id')->unique();
            $table->foreign('personal_detail_id')->references('id')->on('personal_details');
            $table->unsignedInteger('title_id');
            $table->foreign('title_id')->references('id')->on('titles');
            $table->string('position')->nullable();
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
        Schema::drop('professors');
    }
}
