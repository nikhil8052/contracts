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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->text('stripe_product_id')->nullable();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->longtext('first_sec_short_description')->nullable();
            $table->string('first_sec_btn_text');
            $table->longtext('second_sec_long_description')->nullable();
            $table->text('third_sec_heading')->nullable();
            $table->longtext('third_sec_description')->nullable();
            $table->text('button_label')->nullable();
            $table->string('document_image')->nullable();
            $table->json('fourth_section')->nullable();
            $table->string('fifth_section_main_heading')->nullable();
            $table->json('fifth_section_steps')->nullable();
            $table->string('sixth_section_heading')->nullable();
            $table->json('sixth_section_question_answers')->nullable();
            $table->string('last_section_heading')->nullable();
            $table->longtext('last_section_short_description')->nullable();
            $table->json('last_section_related_documents')->nullable();
            $table->string('approved')->nullable();
            $table->longtext('contrato_form_html')->nullable();
            $table->longtext('additional_information')->nullable();
            $table->string('price')->nullable();
            $table->string('no_of_downloads')->nullable();
            $table->string('discount_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
