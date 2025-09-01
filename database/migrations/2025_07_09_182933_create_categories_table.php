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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // نام دسته‌بندی
            $table->string('slug')->unique(); // slug برای URL
            $table->text('description')->nullable(); // توضیحات
            $table->string('image')->nullable(); // تصویر دسته‌بندی
            $table->json('mapping_sources')->nullable(); // مپ کردن دسته‌های منابع مختلف
            $table->boolean('is_active')->default(true); // فعال/غیرفعال
            $table->integer('sort_order')->default(0); // ترتیب نمایش
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
