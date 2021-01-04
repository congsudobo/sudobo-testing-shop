<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class ProductCategories extends Model
{
    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
