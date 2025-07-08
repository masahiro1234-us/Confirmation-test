@extends('layouts.app')

@section('content')
    <h1>お問い合わせ詳細</h1>
    <p>{{ $contact->first_name }} {{ $contact->last_name }}</p>
    <p>{{ $contact->email }}</p>
    <p>{{ $contact->detail }}</p>
@endsection