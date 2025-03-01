<?php

namespace App\Application;

use App\Repositories\CategoryRepository;

class CategoryApplication
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllParentCategories()
    {
        return $this->categoryRepository->getAllParentCategories();
    }

    public function getAllChildCategories($id)
    {
        return $this->categoryRepository->getAllChildCategories($id);
    }
}