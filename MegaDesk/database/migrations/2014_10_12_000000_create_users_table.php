<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 50);
            $table->char('email',50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->char('password', 191);
            $table->integer('authLvl')->default(3);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                'email' => 'Gabriel.Rosales@cvisd.org',
                'name' => 'Gabriel Rosales',
                'password' => '4!pR2@`2KDR;{8<(',
                'authLvl' => 1
                )
        );
        DB::table('users')->insert(
             array(
                'email' => 'Darrell.Cheney@cvisd.org',
                'name' => 'Darrell Cheney',
                'password' => '4!pR2@`2KDR;{8<(',
                'authLvl' => 1
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
        Schema::dropIfExists('users');
    }
}
