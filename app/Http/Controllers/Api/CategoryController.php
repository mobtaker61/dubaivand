<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Category::query();

            // Filter by active status
            if ($request->has('active')) {
                $query->where('is_active', $request->boolean('active'));
            }

            // Search functionality
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }

            // Order by sort_order
            $query->ordered();

            // Pagination
            $perPage = $request->get('per_page', 15);
            $categories = $query->withCount('articles')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $categories->items(),
                'pagination' => [
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'per_page' => $categories->perPage(),
                    'total' => $categories->total(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت دسته‌بندی‌ها',
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
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'mapping_sources' => 'nullable|array',
                'is_active' => 'boolean',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطا در اعتبارسنجی داده‌ها',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // Generate slug from name
            $data['slug'] = Category::createSlug($data['name']);

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('categories', 'public');
                $data['image'] = $imagePath;
            }

            // Set default values
            $data['is_active'] = $data['is_active'] ?? true;
            $data['sort_order'] = $data['sort_order'] ?? 0;

            $category = Category::create($data);

            return response()->json([
                'success' => true,
                'message' => 'دسته‌بندی با موفقیت ایجاد شد',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در ایجاد دسته‌بندی',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {
        try {
            // Check if category is active
            if (!$category->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'دسته‌بندی غیرفعال است'
                ], 404);
            }

            // Load articles relationship
            $category->load(['articles' => function ($query) {
                $query->published()->latest()->take(10);
            }]);

            return response()->json([
                'success' => true,
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در دریافت دسته‌بندی',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255|unique:categories,name,' . $category->id,
                'description' => 'nullable|string|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'mapping_sources' => 'nullable|array',
                'is_active' => 'boolean',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطا در اعتبارسنجی داده‌ها',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();

            // Generate new slug if name changed
            if (isset($data['name']) && $data['name'] !== $category->name) {
                $data['slug'] = Category::createSlug($data['name']);
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($category->image) {
                    Storage::disk('public')->delete($category->image);
                }

                $imagePath = $request->file('image')->store('categories', 'public');
                $data['image'] = $imagePath;
            }

            $category->update($data);

            return response()->json([
                'success' => true,
                'message' => 'دسته‌بندی با موفقیت به‌روزرسانی شد',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در به‌روزرسانی دسته‌بندی',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        try {
            // Check if category has articles
            if ($category->articles()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'نمی‌توان دسته‌بندی دارای مقاله را حذف کرد'
                ], 422);
            }

            // Delete image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'دسته‌بندی با موفقیت حذف شد'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در حذف دسته‌بندی',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
