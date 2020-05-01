<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ass_categories', function (Blueprint $table) {
            $table->bigInteger('assessment_id')->unsigned()->after('id');
            $table->foreign('assessment_id')->references('id')->on('ass_assessments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ass_categories', function (Blueprint $table) {
            //
        });
    }
}
