<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use Illuminate\Http\Request;
use App\Services\ProductsService;
use App\Services\ProductCategoriesService;

class ProductsController extends Controller
{

    public function __construct(ProductsService $productService, ProductCategoriesService $productCategoriesService)
    {
        $this->productService = $productService;
        $this->productCategoriesService = $productCategoriesService;
    }

    public function index(Request $request)
    {
        return view('home');
    }

    public function create(Request $request)
    {
        $productCategories = $this->productCategoriesService->index();
        return view('product_detail', ["categories" => $productCategories]);
    }

    public function store(Request $request)
    {
        $this->productService->store($request);
        $productCategories = $this->productCategoriesService->index();
        return view('product_detail', ["categories" => $productCategories]);
    }
}
