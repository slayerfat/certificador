<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('title_id');
            $table->foreign('title_id')->references('id')->on('titles');
            $table->enum('sex', ['m', 'f']);
            $table->string('first_name', 20);
            $table->string('last_name', 20)->nullable();
            $table->string('first_surname', 20);
            $table->string('last_surname', 20)->nullable();
            $table->unsignedInteger('ci');
            $table->string('phone');
            $table->string('cellphone');
            $table->date('birthday');
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
        Schema::drop('personal_details');
    }
}
