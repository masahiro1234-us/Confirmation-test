<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.*
     * @return void*/
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // カテゴリID
            $table->string('name'); // カテゴリ名
            $table->unsignedBigInteger('user_id'); // 紐づくユーザーID
            $table->timestamps();

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.*
     * @return void*/
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}