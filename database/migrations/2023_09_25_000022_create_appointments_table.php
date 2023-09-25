<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('start_time');
            $table->datetime('finish_time');
            $table->string('reporting_required')->nullable();
            $table->integer('contrast')->nullable();
            $table->integer('films')->nullable();
            $table->longText('history')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
