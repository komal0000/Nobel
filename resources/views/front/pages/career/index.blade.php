@extends('front.layout.app')
@section('metaData')
    @includeIf('front.cache.meta.career')
@endsection

@section('content')
    @includeIf('front.cache.career.slider')
    @includeIf('front.cache.career.latestJobs')
    @includeIf('front.cache.career.job')
    @include('front.pages.career.testinomial')
    @includeIf('front.cache.career.leaderships')
    @includeIf('front.pages.career.resume')
    @includeIf('front.cache.career.life-here')
    @include('front.pages.career.internship')
@endsection
@section('js')
    <script src={{ asset('front/assets/js/career/index.js') }}></script>
@endsection
