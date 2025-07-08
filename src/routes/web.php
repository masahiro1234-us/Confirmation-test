<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// ログインページ
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 新規登録
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// トップページ → 問い合わせフォーム（ログイン必須）
Route::get('/', [ContactController::class, 'index'])->middleware('auth')->name('contacts.index');

// 問い合わせフォーム処理
Route::post('/confirm', [ContactController::class, 'confirm']);
Route::post('/thanks', [ContactController::class, 'store']);
Route::get('/thanks', [ContactController::class, 'thanks']);

// ユーザー管理
Route::get('/users', [UserController::class, 'index']);

// カテゴリー管理
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

// 問い合わせ詳細
Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');

// 管理画面
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

Route::post('/edit', [ContactController::class, 'edit'])->name('contacts.edit');