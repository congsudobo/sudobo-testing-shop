<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer',
            'product_name' => 'required|string',
            'added_date' => 'required|date',
            'count' => 'integer:value',
            'expiration_date' => 'required|date',
            "product_image" => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "category_id" => 'required|integer',
        ];
    }
}
