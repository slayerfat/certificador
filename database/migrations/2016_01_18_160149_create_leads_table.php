<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('institute_id')->nullable();
            $table->foreign('institute_id')->references('id')->on('institutes');
            $table->unsignedInteger('professors_id')->nullable();
            $table->foreign('professors_id')->references('id')->on('professors');
            $table->timestamps();
        });

        Schema::table('professors', function (Blueprint $table) {
            $table->unsignedInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professors', function (Blueprint $table) {
            $table->dropForeign('professors_lead_id_foreign');
            $table->dropColumn('lead_id');
        });

        Schema::drop('leads');
    }
}
