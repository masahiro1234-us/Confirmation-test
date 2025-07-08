<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>FashionablyLate | Login</title>
   <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
   <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body class="login-page">
  <header class="header login-header">
    <div class="header__inner">
      <h1 class="header__logo">FashionablyLate</h1>
      <a href="/register" class="header-register-button">register</a>
    </div>
  </header>

  <main>
    <h1>Login</h1>
    <form action="/login" method="post">
      @csrf
      <label for="email">メールアドレス</label>
      <input type="email" name="email" id="email" placeholder="例）test@example.com">

      <label for="password">パスワード</label>
      <input type="password" name="password" id="password" placeholder="例）coachtech106">

      <button type="submit">ログイン</button>
    </form>
  </main>
</body>
</html>