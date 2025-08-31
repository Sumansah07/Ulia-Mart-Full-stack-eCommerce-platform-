<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductVariationInfoResource;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\ProductVariation;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    # product listing
    public function index(Request $request)
    {
        $searchKey = null;
        $per_page = 12;
        $sort_by = $request->sort_by ? $request->sort_by : "new";
        $maxRange = Product::max('max_price');
        $min_value = 0;
        $max_value = formatPrice($maxRange, false, false, false, false);

        $products = Product::isPublished();

        # conditional - search by
        if ($request->search != null) {
            $products = $products->where('name', 'like', '%' . $request->search . '%');
            $searchKey = $request->search;
        }

        if ($request->has('loadFeaturedProductByCategoryAndThemeId')) {
            if (request()->category_id AND request()->theme_id) {
                $data["products"] = Product::whereHas('categories', function ($query) use ($request) {
                    $query->where('categories.id', $request->category_id)
                        ->whereHas('themes', function ($query) use ($request) {
                            $query->where('themes.id', $request->theme_id);
                        });
                })->isPublished()->get();

                return view("frontend.furniture.pages.partials.products.render-featured-product-card")->with($data)->render();
            }
        }

        # pagination
        if ($request->per_page != null) {
            $per_page = $request->per_page;
        }

        # sort by
        if ($sort_by == 'new') {
            $products = $products->latest();
        } else {
            $products = $products->orderBy('total_sale_count', 'DESC');
        }

        # by price
        if ($request->min_price != null) {
            $min_value = $request->min_price;
        }
        if ($request->max_price != null) {
            $max_value = $request->max_price;
        }

        if ($request->min_price || $request->max_price) {
            $products = $products->where('min_price', '>=', priceToUsd($min_value))->where('min_price', '<=', priceToUsd($max_value));
        }

        # by category
        $category = null;
        if ($request->category_id && $request->category_id != null) {
            $category = Category::find($request->category_id);

            // Check if this is a main category (parent_id is null or 0) or subcategory
            if ($category->parent_id == null || $category->parent_id == 0) {
                // Main category selected: Get products from this category AND all its subcategories
                $categoryIds = [$request->category_id];

                // Get all subcategory IDs
                $subcategoryIds = Category::where('parent_id', $request->category_id)->pluck('id')->toArray();
                $categoryIds = array_merge($categoryIds, $subcategoryIds);

                $product_category_product_ids = ProductCategory::whereIn('category_id', $categoryIds)->pluck('product_id');
            } else {
                // Subcategory selected: Get products only from this specific subcategory
                $product_category_product_ids = ProductCategory::where('category_id', $request->category_id)->pluck('product_id');
            }

            $products = $products->whereIn('id', $product_category_product_ids);
        }

        # by tag
        if ($request->tag_id && $request->tag_id != null) {
            $product_tag_product_ids = ProductTag::where('tag_id', $request->tag_id)->pluck('product_id');
            $products = $products->whereIn('id', $product_tag_product_ids);
        }
        # conditional

        $products = $products->paginate(paginationNumber($per_page));

        $tags = Tag::all();
        return view('frontend.default.pages.products.index', [
            'products'      => $products,
            'searchKey'     => $searchKey,
            'per_page'      => $per_page,
            'sort_by'       => $sort_by,
            'max_range'     => formatPrice($maxRange, false, false, false, false),
            'min_value'     => $min_value,
            'max_value'     => $max_value,
            'tags'          => $tags,
            'category'      => $category,
        ]);
    }

    # product show
    public function show($slug)
    {
        try{
            $product  = Product::query()->with("categories")->slug($slug)->first();
            if(empty($product)){
                return view('errors.not_found');
            }

            if (!$product->is_published) {
                flash(localize('This product is not available'))->info();
                return redirect()->route('home');
            }

            $productCategories              = $product->categories()->pluck('category_id');

            $productIdsWithTheseCategories  = ProductCategory::whereIn('category_id', $productCategories)->where('product_id', '!=', $product->id)->pluck('product_id');

            $relatedProducts                = Product::whereIn('id', $productIdsWithTheseCategories)->get();

            $product_page_widgets = [];
            if (getSetting('product_page_widgets') != null) {
                $product_page_widgets = json_decode(getSetting('product_page_widgets'));
            }

            return view('frontend.default.pages.products.show', ['product' => $product, 'relatedProducts' => $relatedProducts, 'product_page_widgets' => $product_page_widgets]);
        }
        catch(\Throwable $e){
            return view('errors.not_found');
        }
    }

    # product info
    public function showInfo(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.default.pages.partials.products.product-view-box', ['product' => $product]);
    }

    # product variation info
    public function getVariationInfo(Request $request)
    {
        $variationKey = "";
        foreach ($request->variation_id as $variationId) {
            $fieldName      = 'variation_value_for_variation_' . $variationId;
            $variationKey  .=  $variationId . ':' . $request[$fieldName] . '/';
        }
        $productVariation = ProductVariation::where('variation_key', $variationKey)->where('product_id', $request->product_id)->first();

        return new ProductVariationInfoResource($productVariation);
    }
}
