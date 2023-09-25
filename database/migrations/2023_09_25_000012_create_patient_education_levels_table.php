<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientEducationLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('patient_education_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
