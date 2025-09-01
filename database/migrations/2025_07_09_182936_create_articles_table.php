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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان مقاله
            $table->string('slug')->unique(); // slug برای URL
            $table->text('content'); // محتوای مقاله
            $table->text('excerpt')->nullable(); // خلاصه مقاله
            $table->string('featured_image')->nullable(); // تصویر شاخص
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // دسته‌بندی
            $table->string('source_url')->nullable(); // لینک منبع اصلی
            $table->string('source_name')->nullable(); // نام منبع
            $table->json('meta_data')->nullable(); // متادیتای اضافی
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // وضعیت
            $table->timestamp('published_at')->nullable(); // تاریخ انتشار
            $table->integer('view_count')->default(0); // تعداد بازدید
            $table->json('seo_data')->nullable(); // داده‌های SEO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
