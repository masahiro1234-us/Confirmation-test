<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::factory()->create([
            'id' => 1,
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->count(9)->create(); // 残り9人はランダム
    }
}