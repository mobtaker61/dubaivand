<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * نمایش لیست دسته‌بندی‌ها
     */
    public function index()
    {
        $categories = Category::active()
            ->withCount('articles')
            ->ordered()
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * نمایش دسته‌بندی و مقالات آن
     */
    public function show(Category $category)
    {
        // بررسی اینکه دسته‌بندی فعال است
        if (!$category->is_active) {
            abort(404);
        }

        $articles = Article::published()
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(12);

        return view('categories.show', compact('category', 'articles'));
    }
}
