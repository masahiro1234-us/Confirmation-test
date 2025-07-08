<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => '商品のお届けについて', 'user_id' => 1],
            ['name' => '商品の交換について', 'user_id' => 1],
            ['name' => '商品トラブル', 'user_id' => 1],
            ['name' => 'ショップへのお問い合わせ', 'user_id' => 1],
            ['name' => 'その他', 'user_id' => 1],
        ]);
    }
}