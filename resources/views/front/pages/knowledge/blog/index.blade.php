@extends('front.layout.app')

@section('title', 'Blogs')
@section('meta', 'Blogs page for the website')

@section('content')
    @includeIf('front.cache.knowledge.blog');
@endsection

@section('js')
    <script src="{{ asset('front/assets/js/blog/index.js') }}"></script>
@endsection
