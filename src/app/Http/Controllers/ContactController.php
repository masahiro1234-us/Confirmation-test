<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * 問い合わせフォーム表示
     */
    public function index()
    {
        $categories = Category::all(); // DBからcategoriesテーブル全件取得
        return view('contacts.index', compact('categories'));
    }

    /**
     * 確認画面表示
     */
    public function confirm(Request $request)
    {
        // バリデーション
        $inputs = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|email|max:255',
            'tel1' => 'required|numeric',
            'tel2' => 'required|numeric',
            'tel3' => 'required|numeric',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'category' => 'required',
            'detail' => 'required|string|max:120',
        ], [
            'last_name.required' => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'tel1.required' => '電話番号(市外局番)を入力してください',
            'tel2.required' => '電話番号(市内局番)を入力してください',
            'tel3.required' => '電話番号(加入者番号)を入力してください',
            'tel1.numeric' => '電話番号は半角数字で入力してください',
            'tel2.numeric' => '電話番号は半角数字で入力してください',
            'tel3.numeric' => '電話番号は半角数字で入力してください',
            'address.required' => '住所を入力してください',
            'category.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ]);

        // category_id → name に変換
        $category = Category::find($inputs['category']);
        $inputs['category_name'] = $category ? $category->name : '不明';

        return view('contacts.confirm', compact('inputs'));
    }

    /**
     * DB保存処理
     */
    public function store(Request $request)
    {
        // バリデーション
        $inputs = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|email|max:255',
            'tel1' => 'required|numeric',
            'tel2' => 'required|numeric',
            'tel3' => 'required|numeric',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'category' => 'required',
            'detail' => 'required|string|max:120',
        ]);

        // 電話番号結合
        $inputs['tel'] = $inputs['tel1'] . '-' . $inputs['tel2'] . '-' . $inputs['tel3'];

        // user_id を追加
        $inputs['user_id'] = Auth::id();

        // category_id に category をセット
        $inputs['category_id'] = $inputs['category'];

        // 保存
        Contact::create($inputs);

        // 完了画面へ
        return redirect('/thanks')->with('message', 'お問い合わせを送信しました');
    }

    /**
     * 完了画面表示
     */
    public function thanks()
    {
        return view('contacts.thanks');
    }

    /**
     * 問い合わせ詳細表示
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    /**
     * 修正ボタン処理
     */
    public function edit(Request $request)
    {
        // 余分なトークン除外してセッションに保存
        $input = $request->except('_token');
        return redirect('/')->withInput($input);
    }
}