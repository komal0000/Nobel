@extends('front.layout.app')

@section('title', 'Blogs | Nobel Hospital')

@section('meta_title', 'All Blogs | Nobel Hospital')
@section('meta_description', 'All Technologies section available in Nobel Hospital')
@section('meta_keywords', 'technologies')


@section('content')
    @includeIf('front.cache.knowledge.blog');
@endsection

@section('js')
    <script src="{{ asset('front/assets/js/blog/index.js') }}"></script>
@endsection
