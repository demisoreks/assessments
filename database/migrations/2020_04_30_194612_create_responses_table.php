<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ass_responses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('responder_id')->unsigned();
            $table->foreign('responder_id')->references('id')->on('ass_responders');
            $table->bigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('ass_items');
            $table->decimal('item_weight', 10, 2);
            $table->bigInteger('option_id')->unsigned();
            $table->foreign('option_id')->references('id')->on('ass_options');
            $table->text('option_description');
            $table->decimal('option_score', 10, 2);
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
        Schema::dropIfExists('ass_responses');
    }
}
