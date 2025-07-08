<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FashionablyLate - Confirm</title>
   <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
   <link rel="stylesheet" href="{{ asset('css/common.css') }}">
   <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>
<body class="confirm-page">
<header class="header confirm-header">
   <div class="header__inner">
      <h1 class="header__logo">FashionablyLate</h1>
   </div>
</header>

<main>
  <h1>Confirm</h1>

  {{-- 送信フォーム --}}
  <form action="/thanks" method="post">
    @csrf

    <table class="confirm-table">
      <tr>
        <th>お名前</th>
        <td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          @if ($inputs['gender'] == 1)
            男性
          @elseif ($inputs['gender'] == 2)
            女性
          @else
            その他
          @endif
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $inputs['email'] }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $inputs['address'] }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $inputs['building'] ?? '未入力' }}</td>
      </tr>
<tr>
  <th>お問い合わせの種類</th>
  <td>{{ $inputs['category_name'] }}</td>
</tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $inputs['detail'] }}</td>
      </tr>
    </table>

    {{-- hidden inputs --}}
    @foreach ($inputs as $key => $value)
      <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <div class="buttons">
      <button type="submit">送信</button>
  </form>

  {{-- 修正ボタン --}}
  <form action="/edit" method="post" style="display:inline;">
    @csrf
    @foreach ($inputs as $key => $value)
      <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit" name="back" value="true">修正</button>
  </form>
    </div>

</main>
</body>
</html>