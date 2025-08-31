<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(30);
        return CategoryResource::collection($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function topCategory()
    {
        $top_category_ids = getSetting('top_category_ids') != null ? json_decode(getSetting('top_category_ids')) : [];
        $categories = Category::whereIn('id', $top_category_ids)->paginate(30);

        return CategoryResource::collection($categories);
    }

    /**
     * Get all categories with their children
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function all(Request $request)
    {
        try {
            // Check if a specific category ID is requested
            $categoryId = $request->get('category_id');

            // Get all categories with their relationships
            $query = Category::select('id', 'name', 'thumbnail_image', 'parent_id')
                ->with(['categories' => function($query) {
                    $query->select('id', 'name', 'thumbnail_image', 'parent_id');
                }]);

            // If no specific category is requested, get all parent categories
            if (!$categoryId) {
                $categories = $query->whereNull('parent_id')
                    ->orWhere('parent_id', 0)
                    ->get();
            } else {
                // Get all categories to allow filtering on the frontend
                $categories = $query->get();
            }

            return response()->json([
                'success' => true,
                'data' => CategoryResource::collection($categories)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fallback endpoint for categories when main API fails
     * This is a simplified version that returns just the essential data
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fallbackCategories(Request $request)
    {
        try {
            // Check if a specific category ID is requested
            $categoryId = $request->get('category_id');

            // Build the query
            $query = Category::orderBy('sorting_order_level', 'asc')
                ->select('id', 'name', 'parent_id')
                ->limit(20); // Increased limit to ensure we get enough categories

            if ($categoryId) {
                // If category ID is provided, get all categories to allow frontend filtering
                $categories = $query->get();
            } else {
                // Otherwise, get only parent categories
                $categories = $query->where(function($query) {
                        $query->whereNull('parent_id')
                              ->orWhere('parent_id', 0)
                              ->orWhere('parent_id', '');
                    })
                    ->get();
            }

            // If no categories found, return hardcoded ones
            if ($categories->isEmpty()) {
                \Log::warning('No categories found in database, returning hardcoded fallback');

                return response()->json([
                    ['id' => 1, 'name' => 'phone'],
                    ['id' => 3, 'name' => 'clothes'],
                    ['id' => 4, 'name' => 'storee'],
                    ['id' => 8, 'name' => 'storeetb'],
                    ['id' => 9, 'name' => 'ktm'],
                    ['id' => 10, 'name' => 'qwertyu']
                ]);
            }

            \Log::info('Fallback categories: Found ' . $categories->count() . ' categories');
            return response()->json($categories);
        } catch (\Exception $e) {
            \Log::error('Fallback categories error: ' . $e->getMessage());

            // Return hardcoded categories as ultimate fallback
            return response()->json([
                ['id' => 1, 'name' => 'phone'],
                ['id' => 3, 'name' => 'clothes'],
                ['id' => 4, 'name' => 'storee'],
                ['id' => 8, 'name' => 'storeetb'],
                ['id' => 9, 'name' => 'ktm'],
                ['id' => 10, 'name' => 'qwertyu']
            ]);
        }
    }
}
