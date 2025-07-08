<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FashionablyLate - Register</title>
   <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
   <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body class="register-page">
<header class="header register-header">
   <h1 class="header__logo">FashionablyLate</h1>
   <a href="/login" class="header-login-button">login</a>
</header>

  <main>
    <h1>Register</h1>

    <form action="/register" method="post">
      @csrf

      <label for="name">お名前</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例）山田 太郎">

      <label for="email">メールアドレス</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="例）test@example.com">

      <label for="password">パスワード</label>
      <input type="password" name="password" id="password" placeholder="例）coachtech106">

      <button type="submit">登録</button>
    </form>
  </main>
</body>
</html>