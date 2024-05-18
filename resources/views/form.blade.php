@extends('layouts.default')

@section('title', 'GETリクエスト')
@section('content')
    <form action="/query-strings" method="get">
        <label>キーワード：<input type="text" name="keyword"></label>
        <button type="submit">送信</button>
    </form>
@endsection