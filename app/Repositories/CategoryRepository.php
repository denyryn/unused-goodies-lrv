<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAllParentCategories()
    {
        return $this->category->whereNull('parent_id')->get();
    }

    public function getAllChildCategories($id)
    {
        return Category::where('parent_id', $id)->get();
    }
}