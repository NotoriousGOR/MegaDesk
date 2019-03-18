<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('AssignedTo');
            $table->char('CustomerName', 50);
            $table->smallInteger('CampusID');
            $table->char('Room',10);
            $table->smallInteger('Extension');
            $table->longText('Description');
            $table->longText('Comments')->nullable();
            $table->longText('Resolution')->nullable();
            $table->char('TicketStatus', 20)->default('New Issue');
            $table->dateTime('ClosedTimestamp')->nullable();
            $table->smallInteger('ClosedBy')->nullable();
            $table->char('ComCode')->nullable();
            $table->char('SurveyID')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
