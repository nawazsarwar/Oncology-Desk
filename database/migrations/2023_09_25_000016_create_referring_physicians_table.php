<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferringPhysiciansTable extends Migration
{
    public function up()
    {
        Schema::create('referring_physicians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('department')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
