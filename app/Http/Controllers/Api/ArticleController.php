<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->with('category');

            // Filter by category
            if ($request->has('category')) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }

            // Search functionality
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%");
                });
            }

            // Filter by status
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            // Filter by featured
            if ($request->has('featured')) {
                $query->where('is_featured', $request->boolean('featured'));
            }

            // Filter by breaking
            if ($request->has('breaking')) {
                $query->where('is_breaking', $request->boolean('breaking'));
            }

            // Pagination
            $perPage = $request->get('per_page', 15);
            $articles = $query->latest()->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'pagination' => [
                    'current_page' => $articles->currentPage(),
                    'last_page' => $articles->lastPage(),
                    'per_page' => $articles->perPage(),
                    'total' => $articles->total(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت مقالات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'excerpt' => 'nullable|string|max:500',
                'category_id' => 'required|exists:categories,id',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'source_url' => 'nullable|url',
                'source_name' => 'nullable|string|max:255',
                'status' => 'in:draft,published,archived',
                'is_featured' => 'boolean',
                'is_breaking' => 'boolean',
                'published_at' => 'nullable|date',
                'meta_data' => 'nullable|array',
                'seo_data' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطا در اعتبارسنجی داده‌ها',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // Generate slug from title
            $data['slug'] = Article::createSlug($data['title']);

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('articles', 'public');
                $data['featured_image'] = $imagePath;
            }

            // Set default values
            $data['status'] = $data['status'] ?? 'draft';
            $data['is_featured'] = $data['is_featured'] ?? false;
            $data['is_breaking'] = $data['is_breaking'] ?? false;

            $article = Article::create($data);

            // Load category relationship
            $article->load('category');

            return response()->json([
                'success' => true,
                'message' => 'مقاله با موفقیت ایجاد شد',
                'data' => $article
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در ایجاد مقاله',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): JsonResponse
    {
        try {
            // Check if article is published
            if (!$article->isPublished()) {
                return response()->json([
                    'success' => false,
                    'message' => 'مقاله یافت نشد'
                ], 404);
            }

            // Increment view count
            $article->incrementViewCount();

            // Load relationships
            $article->load('category');

            return response()->json([
                'success' => true,
                'data' => $article
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت مقاله',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'sometimes|required|string|max:255',
                'content' => 'sometimes|required|string',
                'excerpt' => 'nullable|string|max:500',
                'category_id' => 'sometimes|required|exists:categories,id',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'source_url' => 'nullable|url',
                'source_name' => 'nullable|string|max:255',
                'status' => 'sometimes|in:draft,published,archived',
                'is_featured' => 'boolean',
                'is_breaking' => 'boolean',
                'published_at' => 'nullable|date',
                'meta_data' => 'nullable|array',
                'seo_data' => 'nullable|array',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطا در اعتبارسنجی داده‌ها',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // Generate new slug if title changed
            if (isset($data['title']) && $data['title'] !== $article->title) {
                $data['slug'] = Article::createSlug($data['title']);
            }

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($article->featured_image) {
                    Storage::disk('public')->delete($article->featured_image);
                }

                $imagePath = $request->file('featured_image')->store('articles', 'public');
                $data['featured_image'] = $imagePath;
            }

            $article->update($data);

            // Load category relationship
            $article->load('category');

            return response()->json([
                'success' => true,
                'message' => 'مقاله با موفقیت به‌روزرسانی شد',
                'data' => $article
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در به‌روزرسانی مقاله',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): JsonResponse
    {
        try {
            // Delete featured image if exists
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }

            $article->delete();

            return response()->json([
                'success' => true,
                'message' => 'مقاله با موفقیت حذف شد'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در حذف مقاله',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get articles by category
     */
    public function getByCategory(Category $category, Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $articles = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->where('category_id', $category->id)
                ->with('category')
                ->orderBy('published_at', 'desc')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'category' => $category,
                'pagination' => [
                    'current_page' => $articles->currentPage(),
                    'last_page' => $articles->lastPage(),
                    'per_page' => $articles->perPage(),
                    'total' => $articles->total(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت مقالات دسته‌بندی',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search articles
     */
    public function search(string $query, Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $articles = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%")
                      ->orWhere('excerpt', 'like', "%{$query}%");
                })
                ->with('category')
                ->orderBy('published_at', 'desc')
                ->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'query' => $query,
                'pagination' => [
                    'current_page' => $articles->currentPage(),
                    'last_page' => $articles->lastPage(),
                    'per_page' => $articles->perPage(),
                    'total' => $articles->total(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در جستجوی مقالات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

        /**
     * Get featured articles
     */
    public function getFeatured(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 10);
            $articles = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->where('is_featured', true)
                ->with('category')
                ->orderBy('published_at', 'desc')
                ->take($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت مقالات ویژه',
                'error' => $e->getMessage()
            ], 500);
        }
    }

        /**
     * Get breaking news
     */
    public function getBreaking(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 10);
            $articles = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->where('is_breaking', true)
                ->with('category')
                ->orderBy('published_at', 'desc')
                ->take($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت اخبار فوری',
                'error' => $e->getMessage()
            ], 500);
        }
    }

        /**
     * Get latest articles
     */
    public function getLatest(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 10);
            $articles = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->orderBy('published_at', 'desc')
                ->with('category')
                ->take($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت آخرین مقالات',
                'error' => $e->getMessage()
            ], 500);
        }
    }

        /**
     * Get popular articles
     */
    public function getPopular(Request $request): JsonResponse
    {
        try {
            $limit = $request->get('limit', 10);
            $articles = Article::where('status', 'published')
                ->where('published_at', '<=', now())
                ->orderBy('view_count', 'desc')
                ->with('category')
                ->take($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت مقالات محبوب',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Increment view count
     */
    public function incrementView(Article $article): JsonResponse
    {
        try {
            $article->incrementViewCount();

            return response()->json([
                'success' => true,
                'message' => 'تعداد بازدید افزایش یافت',
                'view_count' => $article->fresh()->view_count
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در افزایش تعداد بازدید',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle featured status
     */
    public function toggleFeature(Article $article): JsonResponse
    {
        try {
            $article->update(['is_featured' => !$article->is_featured]);

            return response()->json([
                'success' => true,
                'message' => $article->is_featured ? 'مقاله ویژه شد' : 'مقاله از حالت ویژه خارج شد',
                'is_featured' => $article->is_featured
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در تغییر وضعیت ویژه',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle breaking status
     */
    public function toggleBreaking(Article $article): JsonResponse
    {
        try {
            $article->update(['is_breaking' => !$article->is_breaking]);

            return response()->json([
                'success' => true,
                'message' => $article->is_breaking ? 'مقاله به عنوان خبر فوری علامت‌گذاری شد' : 'مقاله از حالت خبر فوری خارج شد',
                'is_breaking' => $article->is_breaking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در تغییر وضعیت خبر فوری',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
