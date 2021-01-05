<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductCategories;

Class ProductCategoriesService
{
    public function index() {
        $productsCategories = ProductCategories::get();
        return $productsCategories;
    }
}