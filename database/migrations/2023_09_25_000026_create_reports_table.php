<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('text')->nullable();
            $table->string('summary')->nullable();
            $table->string('special')->nullable();
            $table->integer('evolving')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
