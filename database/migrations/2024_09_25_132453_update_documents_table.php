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
        Schema::table('documents', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('slug')->nullable()->after('title');
            $table->text('document_image')->nullable();
            $table->string('document_directory_name')->nullable();
            $table->text('document_file_path')->nullable();
            $table->longtext('short_description')->nullable();
            $table->string('btn_text')->nullable();
            $table->longtext('long_description')->nullable();
            $table->text('legal_heading')->nullable();
            $table->longtext('legal_description')->nullable();
            $table->string('legal_btn_text')->nullable();
            $table->text('legal_btn_link')->nullable();
            $table->text('legal_doc_image')->nullable();
            $table->string('directory_name')->nullable();
            $table->text('file_path')->nullable();
            $table->string('published')->nullable();
            $table->integer('doc_price')->nullable();
            $table->longtext('meta_title')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Drop new columns if they exist
            if (Schema::hasColumn('documents', 'doc_title')) {
                $table->dropColumn('doc_title');
            }
            if (Schema::hasColumn('documents', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('documents', 'doc_short_des')) {
                $table->dropColumn('doc_short_des');
            }
            if (Schema::hasColumn('documents', 'doc_btn_text')) {
                $table->dropColumn('doc_btn_text');
            }
            if (Schema::hasColumn('documents', 'doc_long_des')) {
                $table->dropColumn('doc_long_des');
            }
            if (Schema::hasColumn('documents', 'category_id')) {
                $table->dropColumn('category_id');
            }
            if (Schema::hasColumn('documents', 'legal_heading')) {
                $table->dropColumn('legal_heading');
            }
            if (Schema::hasColumn('documents', 'legal_des')) {
                $table->dropColumn('legal_des');
            }
            if (Schema::hasColumn('documents', 'legal_btn_text')) {
                $table->dropColumn('legal_btn_text');
            }
            if (Schema::hasColumn('documents', 'legal_btn_link')) {
                $table->dropColumn('legal_btn_link');
            }
            if (Schema::hasColumn('documents', 'valid_in')) {
                $table->dropColumn('valid_in');
            }
            if (Schema::hasColumn('documents', 'related_doc_heading')) {
                $table->dropColumn('related_doc_heading');
            }
            if (Schema::hasColumn('documents', 'related_doc_des')) {
                $table->dropColumn('related_doc_des');
            }
            if (Schema::hasColumn('documents', 'legal_doc_image')) {
                $table->dropColumn('legal_doc_image');
            }
            if (Schema::hasColumn('documents', 'additional_info')) {
                $table->dropColumn('additional_info');
            }
            if (Schema::hasColumn('documents', 'doc_price')) {
                $table->dropColumn('doc_price');
            }
            if (Schema::hasColumn('documents', 'total_likes')) {
                $table->dropColumn('total_likes');
            }
            if (Schema::hasColumn('documents', 'no_of_downloads')) {
                $table->dropColumn('no_of_downloads');
            }
            if (Schema::hasColumn('documents', 'discount_price')) {
                $table->dropColumn('discount_price');
            }
            if (Schema::hasColumn('documents', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('documents', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }
};
