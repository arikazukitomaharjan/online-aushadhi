<?php

use App\Providers\Constants\TableConstants;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddUserToken extends Migration
{
    public function up()
    {
        Schema::create('user_token', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('token');
            $table->integer('user_id')->unsigned();
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
        Schema::drop('user_token');
    }
}

