@extends('front.layout.app')
@section('title', 'Career');
@section('meta', 'Career page for the website')

@section('content')
    @includeIf('front.cache.career.top-banner')
    @includeIf('front.cache.career.job')
    @include('front.pages.career.testinomial')
    @includeIf('front.cache.career.leaderships')
    @includeIf('front.cache.career.not-sure')
    @includeIf('front.cache.career.life-here')
    @includeIf('front.cache.career.internship')
@endsection
@section('js')
    <script src="front/assets/js/career/index.js"></script>
@endsection
