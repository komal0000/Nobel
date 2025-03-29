@extends('front.layout.app')

@section('title', 'Videos')
@section('meta', 'Videos page for the website')

@section('content')
@includeIf('front.cache.knowledge.video');
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/video/index.js') }}"></script>
@endsection
