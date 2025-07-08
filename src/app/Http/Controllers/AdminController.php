<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
public function index(Request $request)
{
    // Contactモデルのクエリビルダ
    $query = Contact::with('category');

    // Contactテーブルの検索条件
    if ($request->filled('keyword')) {
        $query->where(function($q) use ($request){
            $q->where('first_name', 'like', "%{$request->keyword}%")
              ->orWhere('last_name', 'like', "%{$request->keyword}%")
              ->orWhere('email', 'like', "%{$request->keyword}%");
        });
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('created_at')) {
        $query->whereDate('created_at', $request->created_at);
    }

    // ページネーション
    $contacts = $query->paginate(7);

    // カテゴリ一覧取得
    $categories = Category::all();

    // ユーザー一覧取得
    $users = User::paginate(7);

    // ビューへ渡す
    return view('admin.index', compact('contacts', 'categories', 'users'));
}

    /**
     * エクスポート機能
     */
    public function export(Request $request)
    {
        $query = Contact::query();

        // 検索条件があれば絞り込み
        if ($request->filled('keyword')) {
            $query->where(function($q) use ($request){
                $q->where('first_name', 'like', "%{$request->keyword}%")
                  ->orWhere('last_name', 'like', "%{$request->keyword}%")
                  ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('created_at')) {
            $query->whereDate('created_at', $request->created_at);
        }

        $contacts = $query->get();

        // CSV作成
        $csv = "お名前,性別,メールアドレス,お問い合わせ内容\n";
        foreach ($contacts as $contact) {
            $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $csv .= "{$contact->last_name} {$contact->first_name},{$gender},{$contact->email},{$contact->detail}\n";
        }

        $filename = 'contacts_export_' . date('YmdHis') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        return Response::make(rtrim($csv, "\n"), 200, $headers);
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました。');
    }
}