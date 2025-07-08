<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'first_name' => '山田',
            'last_name' => '太郎',
            'email' => 'yamada@example.com',
            'detail' => '問い合わせ内容のテストです。',
            'user_id' => 1, // 存在する user_id を指定
            'category_id' => 1, // 存在する category_id を指定
        ]);
    }
}