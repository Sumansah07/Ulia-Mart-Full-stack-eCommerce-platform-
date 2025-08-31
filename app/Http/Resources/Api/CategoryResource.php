<?php

namespace App\Http\Resources\Api;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Http\Resources\Json\JsonResource;


class CategoryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Calculate total product count including all subcategories
        $totalProductCount = $this->getTotalProductCount($this->id);

        return[
            "id"=>$this->id,
            "name"=>$this->collectLocalization('name'),
            "products"=>$totalProductCount,
            "thumbnail_image"=>uploadedAsset($this->collectLocalization('thumbnail_image')),
            "subcategories"=> $this->whenLoaded('categories', function() {
                return CategoryResource::collection($this->categories);
            }),
            "parent_id"=>$this->parent_id
        ];
    }

    /**
     * Get total product count for a category including all its subcategories
     */
    private function getTotalProductCount($categoryId)
    {
        // Get direct product count for this category
        $directCount = ProductCategory::where('category_id', $categoryId)->count();

        // Get all subcategory IDs recursively
        $subcategoryIds = $this->getAllSubcategoryIds($categoryId);

        // Get product count from all subcategories
        $subcategoryCount = 0;
        if (!empty($subcategoryIds)) {
            $subcategoryCount = ProductCategory::whereIn('category_id', $subcategoryIds)->count();
        }

        return $directCount + $subcategoryCount;
    }

    /**
     * Get all subcategory IDs recursively
     */
    private function getAllSubcategoryIds($categoryId)
    {
        $subcategoryIds = [];

        // Get immediate children
        $immediateChildren = Category::where('parent_id', $categoryId)->pluck('id')->toArray();

        foreach ($immediateChildren as $childId) {
            $subcategoryIds[] = $childId;
            // Recursively get children of children
            $subcategoryIds = array_merge($subcategoryIds, $this->getAllSubcategoryIds($childId));
        }

        return $subcategoryIds;
    }
    public function with($request)
    {
        return [
            'result' => true,
            'status' => 200
        ];
    }
}
