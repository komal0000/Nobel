@extends('front.layout.app')

@section('title', $news->title.' | Nobel Hospital')

@section('meta_title', $news->title . ' | Nobel Hospital')
@section('meta_description', $news->short_description)
@section('meta_keywords', $news->title)
@section('og_image', asset('storage/' . $news->image))

@section('content')
@includeIf('front.cache.home.news.' . $news_id);
@endsection
