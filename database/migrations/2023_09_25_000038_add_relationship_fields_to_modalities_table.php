<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToModalitiesTable extends Migration
{
    public function up()
    {
        Schema::table('modalities', function (Blueprint $table) {
            $table->unsignedBigInteger('facility_id')->nullable();
            $table->foreign('facility_id', 'facility_fk_9042457')->references('id')->on('facilities');
        });
    }
}
