<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPatientsTable extends Migration
{
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedBigInteger('salutation_id')->nullable();
            $table->foreign('salutation_id', 'salutation_fk_9042432')->references('id')->on('salutations');
            $table->unsignedBigInteger('postal_code_id')->nullable();
            $table->foreign('postal_code_id', 'postal_code_fk_9042431')->references('id')->on('postal_codes');
            $table->unsignedBigInteger('patient_category_id')->nullable();
            $table->foreign('patient_category_id', 'patient_category_fk_9042402')->references('id')->on('patient_categories');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9042403')->references('id')->on('users');
            $table->unsignedBigInteger('province_id')->nullable();
            $table->foreign('province_id', 'province_fk_9042405')->references('id')->on('provinces');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id', 'district_fk_9042415')->references('id')->on('postal_codes');
            $table->unsignedBigInteger('relationship_id')->nullable();
            $table->foreign('relationship_id', 'relationship_fk_9042410')->references('id')->on('patient_guardian_relationships');
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->foreign('nationality_id', 'nationality_fk_9042413')->references('id')->on('countries');
            $table->unsignedBigInteger('occupation_id')->nullable();
            $table->foreign('occupation_id', 'occupation_fk_9042416')->references('id')->on('occupations');
            $table->unsignedBigInteger('education_id')->nullable();
            $table->foreign('education_id', 'education_fk_9042417')->references('id')->on('patient_education_levels');
            $table->unsignedBigInteger('yearly_income_id')->nullable();
            $table->foreign('yearly_income_id', 'yearly_income_fk_9042418')->references('id')->on('patients_income_groups');
            $table->unsignedBigInteger('referred_by_id')->nullable();
            $table->foreign('referred_by_id', 'referred_by_fk_9042654')->references('id')->on('users');
        });
    }
}
