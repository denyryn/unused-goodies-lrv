<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAllProducts()
    {
        return $this->product
            ->with('productImages')
            ->get();
    }

    public function getProductsByCategoryId($id)
    {
        return $this->product->with('productImages')
            ->where('category_id', $id)
            ->get();
    }

    public function getProductsByCategorySlug($categorySlug)
    {
        return $this->product->with('productImages')
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })->get();
    }

    public function getProductById($id)
    {
        return $this->product->with('productImages')
            ->find($id);
    }

    public function getProductBySlug($productSlug)
    {
        return $this->product->with('productImages')
            ->where('slug', $productSlug)
            ->first();
    }
}