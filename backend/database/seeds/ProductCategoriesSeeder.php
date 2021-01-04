<?php

use Illuminate\Database\Seeder;
use App\Models\ProductCategories;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductCategories::class, 5)->create();
    }
}
