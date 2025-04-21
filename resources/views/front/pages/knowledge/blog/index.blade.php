@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.knowledge.blogs.blog')
@endsection


@section('content')
    @includeIf('front.cache.knowledge.blog');
@endsection

@section('js')
    <script src="{{ asset('front/assets/js/blog/index.js') }}"></script>
@endsection
