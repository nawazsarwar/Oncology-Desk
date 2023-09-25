<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->foreign('appointment_id', 'appointment_fk_9042532')->references('id')->on('appointments');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9042540')->references('id')->on('report_statusses');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id', 'template_fk_9042533')->references('id')->on('report_templates');
            $table->unsignedBigInteger('allotted_to_id')->nullable();
            $table->foreign('allotted_to_id', 'allotted_to_fk_9042542')->references('id')->on('users');
            $table->unsignedBigInteger('finalized_by_id')->nullable();
            $table->foreign('finalized_by_id', 'finalized_by_fk_9042538')->references('id')->on('users');
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->foreign('approved_by_id', 'approved_by_fk_9042539')->references('id')->on('users');
        });
    }
}
