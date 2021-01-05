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
        $products = $this->productService->index($request);
        $productCategories = $this->productCategoriesService->index();

        return view('home', [
            "products" => $products->items(), "paginator" => $products,
            "categories" => $productCategories,
            "filter" => $request->only(['id', 'category_id', 'added_date_start', 'added_date_end', 'expiration_date_start', 'expiration_date_end']),
            "is_completed" => $request->input('is_completed'),
        ]);
    }

    public function create(Request $request)
    {
        $productCategories = $this->productCategoriesService->index();

        return view('product_add', ["categories" => $productCategories]);
    }

    public function store(ProductsRequest $request)
    {
        $is_compeleted = $this->productService->store($request);
        $is_compeleted = $is_compeleted ? 1 : 2;
        return redirect("/?is_completed=$is_compeleted");
    }

    public function edit(Request $request)
    {
        $product = $this->productService->edit($request);
        $productCategories = $this->productCategoriesService->index();

        return view('product_update', ["product" => $product, "categories" => $productCategories]);
    }

    public function update(ProductsRequest $request)
    {
        $is_compeleted = $this->productService->store($request);
        $is_compeleted = $is_compeleted ? 1 : 2;

        return redirect("/?is_completed=$is_compeleted");
    }

    public function destroy(Request $request) {
        $is_compeleted = $this->productService->destroy($request);
        $is_compeleted = $is_compeleted ? 1 : 2;

        return redirect("/?is_completed=$is_compeleted");
    }
}
