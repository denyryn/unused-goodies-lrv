<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\ProductApplication;

class ProductController extends Controller
{
    protected $productApplication;

    public function __construct(ProductApplication $productApplication)
    {
        $this->productApplication = $productApplication;
    }

    public function index(Request $request, $categorySlug = null)
    {
        $data = [];
        $data['products'] = $this->productApplication->getProductsByCategory($categorySlug);
        return view('product.show', $data);
    }

    public function show(Request $request, $productSlug)
    {
        $data = [];
        $data['product'] = $this->productApplication->getProductBySlug($productSlug);
        $data['images'] = $data['product']->productImages->pluck('image_path')->toArray();
        return view('product_detail.show', $data);
    }
}
