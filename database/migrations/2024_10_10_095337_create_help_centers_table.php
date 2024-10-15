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
        Schema::create('help_centers', function (Blueprint $table) {
            $table->id();
            $table->text('key')->nullable();
            $table->longtext('value')->nullable();
            $table->text('file_path')->nullable();
            $table->string('type')->nullable();
            $table->text('question')->nullable();
            $table->longtext('answer')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_centers');
    }
};
