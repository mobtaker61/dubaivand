<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'category_id',
        'source_url',
        'source_name',
        'meta_data',
        'status',
        'is_featured',
        'is_breaking',
        'published_at',
        'view_count',
        'seo_data',
    ];

    protected $casts = [
        'meta_data' => 'array',
        'seo_data' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
    ];

    /**
     * رابطه با دسته‌بندی
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope برای مقالات منتشر شده
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope برای مقالات پیش‌نویس
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope برای مقالات ویژه
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope برای اخبار فوری
     */
    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    /**
     * Scope برای مرتب‌سازی بر اساس تاریخ انتشار
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Scope برای مرتب‌سازی بر اساس تعداد بازدید
     */
    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    /**
     * تولید slug از عنوان
     */
    public static function createSlug($title)
    {
        $slug = \Illuminate\Support\Str::slug($title, '-');
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    /**
     * افزایش تعداد بازدید
     */
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    /**
     * بررسی اینکه آیا مقاله منتشر شده است
     */
    public function isPublished(): bool
    {
        return $this->status === 'published' &&
               $this->published_at &&
               $this->published_at <= now();
    }
}
