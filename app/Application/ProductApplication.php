<?php

namespace App\Application;

use App\Repositories\ProductRepository;

class ProductApplication
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductsByCategoryId($id)
    {
        return $this->productRepository->getProductsByCategoryId($id);
    }

    public function getProductsByCategory(?string $categorySlug = null)
    {
        if ($categorySlug) {
            return $this->productRepository->getProductsByCategorySlug($categorySlug);
        }
        return $this->getAllProducts();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function getProductBySlug($productSlug)
    {
        return $this->productRepository->getProductBySlug($productSlug);
    }
}