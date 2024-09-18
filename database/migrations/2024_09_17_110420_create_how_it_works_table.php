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
        Schema::create('how_it_works', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->json('template_section')->nullable();
            $table->string('template_section_image')->nullable();
            $table->text('second_main_heading')->nullable();
            $table->longtext('second_short_description')->nullable();
            $table->json('works')->nullable();
            $table->longtext('join_our_community_text')->nullable();
            $table->text('banner_heading')->nullable();
            $table->text('banner_sub_heading')->nullable();
            $table->string('banner_button_label')->nullable();
            $table->string('banner_button_link')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_it_works');
    }
};
