@extends('layouts.app')

@section('content')
<div class="table-container">
  <h1>ユーザー管理画面</h1>

  <div class="pagination-top-right">
    {{ $users->links() }}
  </div>

  <table class="admin-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>登録日</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at->format('Y/m/d') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection