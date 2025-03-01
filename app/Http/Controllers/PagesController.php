<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UserApplication;
use App\Application\CategoryApplication;
use App\Application\ProductApplication;

class PagesController extends Controller
{
    private UserApplication $userApplication;
    private CategoryApplication $categoryApplication;
    private ProductApplication $productApplication;

    public function __construct(UserApplication $userApplication, CategoryApplication $categoryApplication, ProductApplication $productApplication)
    {
        $this->userApplication = $userApplication;
        $this->categoryApplication = $categoryApplication;
        $this->productApplication = $productApplication;
    }

    public function home()
    {
        $data = [];
        $data['userFirstName'] = auth()->check() ? $this->userApplication->getUserFirstName(auth()->user()->id) : null;
        return view('home.show', $data);
    }

    public function category()
    {
        $data = [];
        $data['parentCategories'] = $this->categoryApplication->getAllParentCategories();
        return view('category.show', $data);
    }

    public function product()
    {
        $data = [];
        $data['products'] = $this->productApplication->getAllProducts();
        return view('category.show', $data);
    }
}
