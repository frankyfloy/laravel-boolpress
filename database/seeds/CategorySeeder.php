<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['arte','cucina','moda', 'musica','cultura','animali'];

        foreach ($categories as $category) {
            $categoryObj = new Category();
            $categoryObj->name = $category;
            $categoryObj->slug = Str::slug($category,'-');
            $categoryObj->save();
        }
    }
}
