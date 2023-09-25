<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentStudyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_study', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id', 'appointment_id_fk_9042506')->references('id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('study_id');
            $table->foreign('study_id', 'study_id_fk_9042506')->references('id')->on('studies')->onDelete('cascade');
        });
    }
}
