<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate | Admin</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-page">
  <header class="header admin-header">
    <div class="header__inner">
      <h1 class="header__logo">FashionablyLate</h1>
      <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="header-logout-button">logout</button>
      </form>
    </div>
  </header>

  <main>
    <h1>Admin</h1>

    <form action="{{ route('admin.index') }}" method="GET" class="search-form">
      @csrf
      <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}" class="input-box">
      <select name="gender">
        <option value="">性別</option>
        <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
      </select>
      <select name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      <input type="date" name="created_at" value="{{ request('created_at') }}">
      <button type="submit">検索</button>
      <button type="button" onclick="location.href='{{ route('admin.index') }}'">リセット</button>
    </form>

    <div class="table-header">
      <form action="{{ route('admin.export') }}" method="GET">
        @csrf
        <button type="submit" class="export-button">エクスポート</button>
      </form>

      <div class="pagination-container">
        {{ $contacts->links() }}
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>名前</th>
          <th>性別</th>
          <th>メールアドレス</th>
          <th>お問い合わせの種類</th>
          <th>詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($contacts as $contact)
          <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>
              @if ($contact->gender == 1)
                男性
              @elseif ($contact->gender == 2)
                女性
              @else
                その他
              @endif
            </td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->name ?? 'なし' }}</td>
            <td>
              <button onclick="showContactDetail(
                '{{ $contact->id }}',
                '{{ $contact->last_name }} {{ $contact->first_name }}',
                '{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}',
                '{{ $contact->email }}',
                '{{ $contact->tel ?? '未登録' }}',
                '{{ $contact->address ?? '未登録' }}',
                '{{ $contact->building ?? '未登録' }}',
                '{{ $contact->category->name ?? 'なし' }}',
                '{{ $contact->detail ?? 'なし' }}'
              )">詳細</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- 詳細モーダル -->
    <div id="contact-detail-modal" class="modal" style="display:none;">
      <div class="modal-content">
        <span class="close" onclick="closeContactDetail()">&times;</span>
        <table class="modal-table">
          <tr><th>名前</th><td id="detail-name"></td></tr>
          <tr><th>性別</th><td id="detail-gender"></td></tr>
          <tr><th>メール</th><td id="detail-email"></td></tr>
          <tr><th>電話番号</th><td id="detail-tel"></td></tr>
          <tr><th>住所</th><td id="detail-address"></td></tr>
          <tr><th>建物名</th><td id="detail-building"></td></tr>
          <tr><th>お問い合わせの種類</th><td id="detail-category"></td></tr>
          <tr><th>お問い合わせ内容</th><td id="detail-detail"></td></tr>
        </table>
        <form id="delete-form" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="delete-button">削除</button>
        </form>
      </div>
    </div>
  </main>

  <script>
function showContactDetail(id, name, gender, email, tel, address, building, category, detail) {
  document.getElementById('delete-form').action = '/admin/delete/' + id;
  document.getElementById('detail-name').textContent = name;
  document.getElementById('detail-gender').textContent = gender;
  document.getElementById('detail-email').textContent = email;
  document.getElementById('detail-tel').textContent = tel;
  document.getElementById('detail-address').textContent = address;
  document.getElementById('detail-building').textContent = building;
  document.getElementById('detail-category').textContent = category;
  document.getElementById('detail-detail').textContent = detail;
  document.getElementById('contact-detail-modal').style.display = 'block';
}

function closeContactDetail() {
  document.getElementById('contact-detail-modal').style.display = 'none';
}
  </script>
</body>
</html>