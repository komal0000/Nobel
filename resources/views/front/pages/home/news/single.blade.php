@extends('front.layout.app')

@section('title', 'News')
@section('meta', '')

@section('content')
@includeIf('front.cache.home.news.'.$news_id);
@endsection
