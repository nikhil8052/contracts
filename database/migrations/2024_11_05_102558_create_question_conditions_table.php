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
            $table->integer('conditional_check')->comment('1: is equal to; 2: is greater than; 3: is less than; 4: not equal to');
            $table->boolean('status')->default(1); // Indicates if condition should be executed
            $table->unsignedBigInteger('go_to_step')->nullable(); // New field for go-to step question
            $table->timestamps();

            // Foreign keys
            $table->foreign('conditional_question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('go_to_step')->references('id')->on('questions')->onDelete('cascade'); // Foreign key for go_to_step
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
