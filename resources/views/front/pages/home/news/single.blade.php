@extends('front.layout.app')

@section('title', $news->title)
@section('meta', $news->title.' Page')

@section('content')
@includeIf('front.cache.home.news.'.$news_id);
@endsection
