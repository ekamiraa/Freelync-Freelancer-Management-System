<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Web Development',
            'Graphic Design',
            'Digital Marketing',
            'Content Writing',
            'Data Science/Analyst',
            'UI/UX Design',
            'Software Development',
            'Video Editor',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
