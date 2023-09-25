<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id', 'patient_fk_9042492')->references('id')->on('patients');
            $table->unsignedBigInteger('priority_level_id')->nullable();
            $table->foreign('priority_level_id', 'priority_level_fk_9042502')->references('id')->on('priority_levels');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9042497')->references('id')->on('appointments_statusses');
            $table->unsignedBigInteger('investigation_performed_by_id')->nullable();
            $table->foreign('investigation_performed_by_id', 'investigation_performed_by_fk_9042498')->references('id')->on('users');
            $table->unsignedBigInteger('referring_physician_id')->nullable();
            $table->foreign('referring_physician_id', 'referring_physician_fk_9042499')->references('id')->on('referring_physicians');
            $table->unsignedBigInteger('added_by_id')->nullable();
            $table->foreign('added_by_id', 'added_by_fk_9042505')->references('id')->on('users');
        });
    }
}
