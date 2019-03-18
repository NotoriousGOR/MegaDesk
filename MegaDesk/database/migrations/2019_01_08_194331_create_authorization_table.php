<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorization', function (Blueprint $table) {
            $table->increments('AuthLvl');
            $table->char('AuthDesc');
        });
        DB::table('authorization')->insert(
            array(
                'AuthDesc' => 'Admin'
            )
        );
        DB::table('authorization')->insert(
            array(
                'AuthDesc' => 'Call Center'
            )
        );
        DB::table('authorization')->insert(
            array(
                'AuthDesc' => 'Technician'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorization');
    }
}
