@extends('layouts.app')

@section('content')
    <h1>{{ $category->name }}</h1>

    <p>ID: {{ $category->id }}</p>
    <p>作成日: {{ $category->created_at }}</p>
    <p>更新日: {{ $category->updated_at }}</p>
@endsection