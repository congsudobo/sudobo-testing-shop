<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategories;

class Products extends Model
{
    /**
     * Get the post that owns the Product.
     */
    public function category()
    {
        return $this->belongsTo(ProductCategories::class);
    }
}
