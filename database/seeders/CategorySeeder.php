<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['mode' => 'outgoing', 'category' => 'food'],
            ['mode' => 'outgoing', 'category' => 'rent'],
            ['mode' => 'outgoing', 'category' => 'transportation'],
            ['mode' => 'outgoing', 'category' => 'loan'],
            ['mode' => 'outgoing', 'category' => 'shopping'],
            ['mode' => 'outgoing', 'category' => 'mobile'],
            ['mode' => 'outgoing', 'category' => 'savings'],
            ['mode' => 'outgoing', 'category' => 'school'],
            ['mode' => 'outgoing', 'category' => 'others'],

            ['mode' => 'ingoing', 'category' => 'provider'],
            ['mode' => 'ingoing', 'category' => 'earnings'],
            ['mode' => 'ingoing', 'category' => 'grant'],
            ['mode' => 'ingoing', 'category' => 'loan'],
            ['mode' => 'ingoing', 'category' => 'others'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'mode' => $cat['mode'],
                'category' => $cat['category']
            ]);
        }
    }
}
