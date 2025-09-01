<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'mapping_sources',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'mapping_sources' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * رابطه با مقالات
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Scope برای دسته‌بندی‌های فعال
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope برای مرتب‌سازی
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

        /**
     * تولید slug از نام
     */
    public static function createSlug($name)
    {
        $slug = \Illuminate\Support\Str::slug($name, '-');
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
