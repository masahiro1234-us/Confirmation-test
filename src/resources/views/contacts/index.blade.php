<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FashionablyLate - Contact</title>
   <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
   <link rel="stylesheet" href="{{ asset('css/common.css') }}">
   <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body class="contact-page">
<header class="header contact-header">
   <div class="header__inner">
      <h1 class="header__logo">FashionablyLate</h1>
   </div>
</header>

<main>
  <h1>Contact</h1>

  @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li style="color:red;">{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="/confirm" method="post">
    @csrf

    {{-- お名前（姓・名） --}}
    <div class="form-group name-group">
      <label>お名前 <span class="required">*</span></label>
      <div class="name-inputs">
        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例）山田">
        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例）太郎">
      </div>
    </div>

    {{-- 性別 --}}
    <div class="form-group gender-group">
      <label>性別 <span class="required">*</span></label>
      <div class="gender-options">
        <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
      </div>
    </div>

    {{-- メールアドレス --}}
    <div class="form-group">
      <label for="email">メールアドレス <span class="required">*</span></label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例）test@example.com">
    </div>

    {{-- 電話番号 --}}
    <div class="form-group tel-group">
      <label>電話番号 <span class="required">*</span></label>
      <div class="tel-inputs">
        <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="例）080">
        -
        <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="例）1234">
        -
        <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="例）5678">
      </div>
    </div>

    {{-- 住所 --}}
    <div class="form-group">
      <label for="address">住所 <span class="required">*</span></label>
      <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="例）東京都渋谷区千駄ヶ谷1-2-3">
    </div>

    {{-- 建物名 --}}
    <div class="form-group">
      <label for="building">建物名</label>
      <input type="text" name="building" id="building" value="{{ old('building') }}" placeholder="例）千駄ヶ谷マンション101">
    </div>

    {{-- お問い合わせ種類 --}}
    <div class="form-group">
      <label for="category">お問い合わせ種類 <span class="required">*</span></label>
      <select name="category" id="category">
        <option value="">選択してください</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- お問い合わせ内容 --}}
    <div class="form-group">
      <label for="detail">お問い合わせ内容 <span class="required">*</span></label>
      <textarea name="detail" id="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
    </div>

    <button type="submit">確認画面へ</button>
  </form>
</main>
</body>
</html>