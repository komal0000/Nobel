@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.home.news.'.$slug)
@endsection

@section('content')
@includeIf('front.cache.home.news.' . $news->id);
@endsection
