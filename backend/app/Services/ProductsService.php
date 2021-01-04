<?php

namespace App\Services;

use App\Models\Products;
use App\Traits\StorageTrait;

Class ProductsService
{
    use StorageTrait;

    public function store($request) {
        $storeImagePath = config("product.product_image_path");
        $fileName = $this->buildFile($request, $storeImagePath);

        if(!$fileName) {
            return false;
        }

        $product = $this->buildProduct($request);
        $product->product_image = "$storeImagePath\\$fileName";

        try {
            \DB::beginTransaction();

            $product->save();

            \DB::commit();
        } catch(\PDOException $ex) {
            \DB::rollback();
            $this->deleteFile("$storeImagePath\\$fileName");

            return false;
        }

        return true;
    }

    private function buildFile($request, $storeImagePath) {
        if(!$request->file("product_image")) {
            return null;
        }

        return $this->uploadFile($request->file("product_image"), $storeImagePath);
    }

    private function buildProduct($request) {
        $product = new Products();
        $product->id = $request->input("id");
        $product->product_name = $request->input("product_name");
        $product->product_image = $request->input("product_image");
        $product->count = $request->input("count");
        $product->added_date = $request->input("added_date");
        $product->expiration_date = $request->input("expiration_date");
        $product->category_id = $request->input("category_id");

        return $product;
    }

    public function destroy($id) {
        $storeImagePath = config("product.product_image_path");
        $product = Products::where('id',$id)
        ->withTrashed()
        ->first();

        if(!$product) {
            return false;
        }

        try {
            \DB::beginTransaction();

            $product->delete();

            \DB::commit();
            $this->deleteFile("$storeImagePath\\$product->product_image");
        } catch(\PDOException $ex) {
            \DB::rollback();
            return false;
        }

        return true;
    }

    public function index($request) {
        $productQuery = Products::with("category");

        $this->buildSortQuery($request, $productQuery);
        $this->buildPagination($request, $productQuery);

        $products = $productQuery->get();
        return $products;
    }

    private function buildPagination($request, $query) {
        $pagination = $request->input("limit") ?? config("product.pagination.max_item");

        $query->paginate($pagination);
    }

    private function buildSortQuery($request, $query) {
        $searchId = $request->input("searchId");
        $addedStart = $request->input("addedStart");
        $addedEnd = $request->input("addedEnd");
        $expirationStart = $request->input("expirationStart");
        $expirationEnd = $request->input("expirationEnd");
        $categoryId = $request->input("categoryId");

        if($searchId) {
            $query->where("id", $searchId);
        }

        if($addedStart && $addedEnd) {
            $query->whereBetween("added_date", [$addedStart, $addedEnd]);
        }

        if($expirationStart && $expirationEnd) {
            $query->whereBetween("expiration_date", [$expirationStart, $expirationEnd]);
        }

        if($categoryId) {
            $query->where("category_id", $categoryId);
        }
    }
}