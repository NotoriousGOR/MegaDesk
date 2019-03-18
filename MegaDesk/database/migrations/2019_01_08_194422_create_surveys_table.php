<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('TicketID');
            $table->boolean('FilledOut')->default(0);
            $table->date('Expiration');
            $table->smallInteger('Rating')->nullable();
            $table->boolean('Satisfied')->default(0);
            $table->text('SatisfiedDetails')->nullable();
            $table->text('SurveyComments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
