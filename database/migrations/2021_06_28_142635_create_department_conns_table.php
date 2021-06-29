<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Связующая таблица для пользователей и отделов

class CreateDepartmentConnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_conns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");//Внешний ключ к пользователю
            $table->bigInteger('dep_id')->unsigned();
            $table->foreign('dep_id')->references('id')->on('departments')->onDelete("cascade");//Внешний ключ к отделу
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
        Schema::dropIfExists('department_conns');
    }
}
