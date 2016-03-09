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
            $table->foreign('user_id')->references('id')->on('users');
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

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('personal_details_id')->nullable();
            $table->foreign('personal_details_id')->references('id')->on('personal_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_personal_details_id_foreign');
            $table->dropColumn('personal_details_id');
        });

        Schema::drop('personal_details');
    }
}
