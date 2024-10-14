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
            $table->text('title')->nullable();
            $table->text('slug')->nullable()->after('title');
            $table->text('document_image')->nullable();
            $table->string('document_directory_name')->nullable();
            $table->text('document_file_path')->nullable();
            $table->longtext('short_description')->nullable();
            $table->string('btn_text')->nullable();
            $table->longtext('long_description')->nullable();
            $table->text('guide_main_heading')->nullable();
            $table->text('legal_heading')->nullable();
            $table->longtext('legal_description')->nullable();
            $table->string('legal_btn_text')->nullable();
            $table->text('legal_btn_link')->nullable();
            $table->text('legal_doc_image')->nullable();
            $table->string('directory_name')->nullable();
            $table->text('file_path')->nullable();
            $table->string('published')->nullable();
            $table->string('valid_in')->nullable();
            $table->json('category_id')->nullable();
            $table->text('related_heading')->nullable();
            $table->longtext('related_description')->nullable();
            $table->longtext('additional_info')->nullable();
            $table->integer('doc_price')->nullable();
            $table->integer('total_likes')->nullable();
            $table->integer('no_of_downloads')->nullable()->after('total_likes');
            $table->integer('discount_price')->nullable()->after('no_of_downloads');
            $table->string('format')->nullable();
            $table->string('reviews')->default('1');
            $table->tinyInteger('status')->nullable();
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
