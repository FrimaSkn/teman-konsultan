<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('fraud_status');
            $table->integer('gross_amount');
            $table->string('payment_type');
            $table->string('transaction_id');
            $table->string('transaction_status');
            $table->date('transaction_time');
            $table->string('url')->nullable();
            $table->string('status_code')->nullable();
            $table->string('status_message')->nullable();
            $table->text('va_numbers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
