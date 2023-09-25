<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsStatussesTable extends Migration
{
    public function up()
    {
        Schema::create('appointments_statusses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
