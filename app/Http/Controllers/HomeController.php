<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * نمایش صفحه اصلی
     */
    public function index()
    {
        try {
            // مقالات با تصویر برای اسلایدر Hero
            $heroSliderArticles = Article::published()
                ->whereNotNull('featured_image')
                ->with('category')
                ->latest()
                ->take(5)
                ->get();

            // دریافت دسته‌بندی‌های فعال
            $categories = Category::active()
                ->withCount('articles')
                ->ordered()
                ->take(8)
                ->get();

            // دریافت 4 مقاله آخر از هر دسته‌بندی
            $articlesByCategory = [];
            foreach ($categories as $category) {
                $articlesByCategory[$category->id] = Article::published()
                    ->where('category_id', $category->id)
                    ->with('category')
                    ->latest()
                    ->take(4)
                    ->get();
            }
        } catch (\Exception $e) {
            // در صورت خطا، آرایه‌های خالی برگردان
            $heroSliderArticles = collect();
            $categories = collect();
            $articlesByCategory = [];
        }

        return view('home', compact('heroSliderArticles', 'categories', 'articlesByCategory'));
    }
}
