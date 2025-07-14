<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            '商品の届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category, // ← 正しいカラム名
                'user_id' => 1
            ]);
        }
    }
}