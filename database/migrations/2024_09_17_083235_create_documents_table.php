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
            $table->text('doc_title')->nullable();
            $table->text('slug')->nullable();
            $table->longtext('doc_short_des')->nullable();
            $table->string('doc_btn_text')->nullable();
            $table->longtext('doc_long_des')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('legal_heading')->nullable();
            $table->longtext('legal_des')->nullable();
            $table->string('legal_btn_text')->nullable();
            $table->string('legal_btn_link')->nullable();
            $table->string('valid_in')->nullable();
            $table->string('related_doc_heading')->nullable();
            $table->longtext('related_doc_des')->nullable();
            $table->string('additional_info')->nullable();
            $table->integer('doc_price')->nullable();
            $table->integer('no_of_downloads')->nullable();
            $table->integer('total_likes')->nullable();
            $table->integer('discount_price')->nullable();
            $table->interger('legal_doc_image')->nullable();
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
