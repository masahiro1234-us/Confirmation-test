@@extends('layouts.app')

@section('content')
    <h1>カテゴリー一覧</h1>

    <ul>
        @foreach ($categories as $category)
            <li>
                {{ $category->name }}
                <a href="{{ route('categories.show', $category->id) }}">詳細</a>
            </li>
        @endforeach
    </ul>
@endsection