<?php

namespace App\Services;

use App\Models\Products;
use App\Traits\StorageTrait;

Class ProductsService
{
    use StorageTrait;

    public function store($request) {
        $storeImagePath = config("product.product_image_path");
        $product = new Products();

        if($request->input('id')) {
            $product = Products::find($request->input('id'));
        }

        if(!$product) {
            return false;
        }

        $this->buildProduct($request, $product, $storeImagePath);

        if(!$product->product_image) {
            return false;
        }

        try {
            \DB::beginTransaction();

            $product->save();

            \DB::commit();
            if(isset($product->id)) {
                $oldFileName = $product->getOriginal('product_image');
                $newFileName = $product->product_image;
                if($oldFileName != $newFileName) {
                    $this->deleteFile($oldFileName);
                }
            }
        } catch(\PDOException $ex) {
            \DB::rollback();
            $this->deleteFile($product->product_image);

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

    private function buildProduct($request, $product, $storeImagePath) {
        $newFileName = $this->buildFile($request, $storeImagePath);
        $oldFileName = $product->getOriginal('product_image');
        $product->id = $request->input("id");
        $product->product_name = $request->input("product_name");
        $product->product_image = "$storeImagePath/$newFileName" ?? $oldFileName;
        $product->count = $request->input("count");
        $product->added_date = $request->input("added_date");
        $product->expiration_date = $request->input("expiration_date");
        $product->category_id = $request->input("category_id");
    }

    public function destroy($request) {

        $storeImagePath = config("product.product_image_path");
        $product = Products::where('id',$request->input("id"))
        ->first();

        if(!$product) {
            return false;
        }

        try {
            \DB::beginTransaction();

            $product->delete();

            \DB::commit();
            $this->deleteFile("$product->product_image");
        } catch(\PDOException $ex) {
            \DB::rollback();
            return false;
        }

        return true;
    }

    public function index($request) {
        $productQuery = Products::with("category");

        $this->buildSortQuery($request, $productQuery);
        $products = $this->buildPagination($request, $productQuery);

        return $products;
    }

    private function buildPagination($request, $query) {
        $pagination = $request->input("limit") ?? config("product.pagination.max_item");

        return $query->paginate($pagination);
    }

    private function buildSortQuery($request, $query) {
        $searchId = $request->input("id");
        $addedStart = $request->input("added_date_start");
        $addedEnd = $request->input("added_date_end");
        $expirationStart = $request->input("expiration_date_start");
        $expirationEnd = $request->input("expiration_date_end");
        $categoryId = $request->input("category_id");

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

    public function edit($request) {
        $productId = $request->input("id");

        if(!$productId) {
            return false;
        }

        $product = Products::find($productId);
        $product->added_date = date("Y-m-d", strtotime($product->added_date));
        $product->expiration_date = date("Y-m-d", strtotime($product->expiration_date));

        if(!$product) {
            return false;
        }

        return $product;
    }
}