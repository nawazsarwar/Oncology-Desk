<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('registration_date')->nullable();
            $table->boolean('is_mlc_patient')->default(0)->nullable();
            $table->string('uhid_number')->nullable();
            $table->string('abha')->nullable();
            $table->string('mobile_number');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender');
            $table->date('dob')->nullable();
            $table->integer('patient_age_in_years');
            $table->integer('patient_age_in_months')->nullable();
            $table->integer('patient_age_in_days')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('address')->nullable();
            $table->string('gurdian_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mlc_number')->nullable();
            $table->string('police_station')->nullable();
            $table->string('mlc_remark')->nullable();
            $table->boolean('is_referred_patient')->default(0)->nullable();
            $table->string('referring_hospital')->nullable();
            $table->string('referring_department')->nullable();
            $table->date('reffered_on')->nullable();
            $table->string('referring_uhid')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
