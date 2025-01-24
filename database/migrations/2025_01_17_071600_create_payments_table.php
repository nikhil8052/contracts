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
        Schema::create('transactions', function (Blueprint $table) {     
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('payment_intent')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('discount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('method')->nullable();
            $table->string('type')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('is_discount_applied')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
