<?php

namespace App\Http\Services;

use App\Models\Products;
use App\Traits\StorageTrait;

Class ProductService
{
    use StorageTrait;

    public function store($request) {
        $storeImagePath = config("product.product_image_path");
        $fileName = $this->buildFile($request, $storeImagePath);
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
        $product->expriration_date = $request->input("expriration_date");
        $product->category_id = $request->input("category_id");

        return $product;
    }

    private function destroy($id) {
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
}