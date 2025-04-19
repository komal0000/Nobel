@extends('front.layout.app')
@section('title', 'Health Library | Nobel Hospital')

@section('meta_title', 'Health Library | Nobel Hospital')
@section('meta_description', 'Health Library of Nobel Hospital')
@section('meta_keywords', 'health library, health library nobel')


@section('content')
    @include('front.pages.health.banner')
    @includeIF('front.cache.health.diseases')
    @include('front.pages.health.health-library')
    @include('front.pages.health.health-care')
    @includeIF('front.cache.health.technology')
    @include('front.pages.health.knowledge')
    @includeIF('front.cache.health.download')
    @includeIF('front.cache.health.event')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/health/index.js') }}"></script>
@endsection
