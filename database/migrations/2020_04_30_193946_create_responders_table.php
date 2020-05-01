<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespondersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ass_responders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('organization_name');
            $table->text('reviewer_name');
            $table->bigInteger('assessment_id')->unsigned();
            $table->foreign('assessment_id')->references('id')->on('ass_assessments');
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
        Schema::dropIfExists('ass_responders');
    }
}
