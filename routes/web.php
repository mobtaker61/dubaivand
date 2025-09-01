<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// صفحه اصلی
Route::get('/', [HomeController::class, 'index'])->name('home');

// مقالات
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// دسته‌بندی‌ها
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// درباره ما
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// تست - حذف شود بعد از دیباگ
Route::get('/test-articles', function () {
    $allArticles = \App\Models\Article::with('category')->get();
    $publishedArticles = \App\Models\Article::published()->with('category')->get();

    echo "همه مقالات:\n";
    dd([
        'all_articles' => $allArticles->toArray(),
        'published_articles' => $publishedArticles->toArray(),
        'now' => now()->toDateTimeString(),
        'published_at' => $allArticles->first()?->published_at?->toDateTimeString() ?? 'null'
    ]);
});
