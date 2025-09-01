<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * نمایش لیست مقالات
     */
    public function index(Request $request)
    {
        $query = Article::published()->with('category');

        // فیلتر بر اساس دسته‌بندی
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // جستجو
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest()->paginate(12);
        $categories = Category::active()->withCount('articles')->ordered()->get();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * نمایش مقاله
     */
    public function show(Article $article)
    {
        // بررسی اینکه مقاله منتشر شده است
        if (!$article->isPublished()) {
            abort(404);
        }

        // افزایش تعداد بازدید
        $article->incrementViewCount();

        // مقالات مرتبط
        $relatedArticles = Article::published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(4)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
