@extends('front.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @includeif('front.cache.home.slider')
    @include('front.pages.home.speciality')
    @include('front.pages.home.team')
    @includeIf('front.cache.home.care')
    @includeIf('front.cache.home.updates')
    @includeIf('front.cache.home.awards')
    @includeIf('front.cache.home.newsEvent')
@endsection
@section('js')
    <script src="front/assets/js/home/index.js"></script>
@endsection
