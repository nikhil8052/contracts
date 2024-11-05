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
        Schema::create('question_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); // Foreign key to questions table
            $table->enum('condition_type', ['question_label_condition', 'go_to_step_condition']); // Condition type
            $table->string('question_label')->nullable(); // Label to show if condition matches
            $table->unsignedBigInteger('conditional_question_id'); // Question ID to check condition on
            $table->string('conditional_question_value'); // Value to check against for the condition
            $table->boolean('status')->default(1); // Indicates if condition should be executed
            $table->timestamps();
            
            
            // Foreign key for conditional question ID
            $table->foreign('conditional_question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_conditions');
    }
};
