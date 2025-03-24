@extends('front.layout.app')
@section('title', 'Career');
@section('meta', 'Career page for the website')

@section('content')
    @include('front.pages.career.topbanner')
    @includeIf('front.cache.career.job')
    @include('front.pages.career.testinomial')
    @includeIf('front.cache.career.leaderships')
    @includeIf('front.pages.career.resume')
    @includeIf('front.cache.career.life-here')
    @includeIf('front.cache.career.internship')
@endsection
@section('js')
    <script src="front/assets/js/career/index.js"></script>
@endsection
