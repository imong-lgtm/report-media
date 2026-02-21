<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
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
        $categories = [
            'Nasional',
            'Olahraga',
            'Teknologi',
            'Kesehatan',
            'Otomotif',
            'Politik',
            'Ekonomi'
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
            ['slug' => Str::slug($cat)],
            ['name' => $cat]
            );
        }
    }
}
