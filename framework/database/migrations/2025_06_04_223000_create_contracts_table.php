<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->string('contract_number')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration')->nullable();
            $table->decimal('daily_rate', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('advance_payment', 10, 2)->nullable();
            $table->decimal('remaining_amount', 10, 2)->nullable();
            $table->string('status', 50)->nullable();
            $table->text('notes')->nullable();
            $table->string('start_location')->nullable();
            $table->string('end_location')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->decimal('franchise', 10, 2)->nullable();
            $table->text('client_signature')->nullable();
            $table->text('witness_signature')->nullable();
            $table->datetime('signed_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('pickup_branch_id')->nullable();
            $table->unsignedInteger('dropoff_branch_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
