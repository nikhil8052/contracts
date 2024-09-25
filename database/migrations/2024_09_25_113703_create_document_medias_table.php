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
        Schema::create('document_medias', function (Blueprint $table) {
            $table->id();
            $table->integer('document_id')->nullable();
            $table->string('img_heading')->nullable();
            $table->longText('img_des')->nullable();
            $table->string('images')->nullable();
            $table->string('directory_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_medias');
    }
};
