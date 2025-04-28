@extends('front.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" />
@endsection
@section('metaData')
    @includeIf('front.cache.meta.home.home')
@endsection
@section('content')
    @includeIf('front.cache.home.popup')
    
    @include('front.pages.home.slider')
    @include('front.pages.home.speciality')
    @include('front.pages.home.team')
    @includeIf('front.cache.home.care')
    @includeIf('front.cache.home.services')
    @includeIf('front.cache.home.videos')
    @includeIf('front.pages.home.national')
    @includeIf('front.cache.home.updates')
    @includeIf('front.cache.home.awards')
    @includeIf('front.cache.home.newsEvent')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/home/index.js') }}"></script>
    <script>
    $(document).ready(function() {console.log('testing')});
    </script>
@endsection
