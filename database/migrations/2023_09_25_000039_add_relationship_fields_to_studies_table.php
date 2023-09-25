<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudiesTable extends Migration
{
    public function up()
    {
        Schema::table('studies', function (Blueprint $table) {
            $table->unsignedBigInteger('modality_id')->nullable();
            $table->foreign('modality_id', 'modality_fk_9042475')->references('id')->on('modalities');
            $table->unsignedBigInteger('facility_id')->nullable();
            $table->foreign('facility_id', 'facility_fk_9042481')->references('id')->on('facilities');
        });
    }
}
