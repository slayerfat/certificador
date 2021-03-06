<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstituteProfessorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_professor', function (Blueprint $table) {
            $table->unsignedInteger('institute_id')->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes');
            $table->unsignedInteger('professor_id')->nullable();
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->boolean('leads')->default(false);
            $table->string('position')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('institute_professor');
    }
}
