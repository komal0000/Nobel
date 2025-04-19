@extends('front.layout.app')

@section('title', 'Videos | Nobel Hospital')

@section('meta_title', 'Videos | Nobel Hospital')
@section('meta_description', 'All Videos section available in Nobel Hospital')
@section('meta_keywords', 'videos, videos nobel')


@section('content')
@includeIf('front.cache.knowledge.video');
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/video/index.js') }}"></script>
@endsection
