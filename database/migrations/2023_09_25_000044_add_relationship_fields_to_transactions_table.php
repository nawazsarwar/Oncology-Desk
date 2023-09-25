<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id', 'type_fk_9042582')->references('id')->on('transaction_types');
            $table->unsignedBigInteger('transactionable_id')->nullable();
            $table->foreign('transactionable_id', 'transactionable_fk_9042583')->references('id')->on('appointments');
        });
    }
}
