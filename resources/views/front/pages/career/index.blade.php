@extends('front.layout.app')
@section('title', 'Career');
@section('meta', 'Career page for the website')

@section('content')
    @includeIf('front.cache.career.top-banner')
    @includeIf('front.cache.career.profession')
    @includeIf('front.cache.career.content')
    @includeIf('front.cache.career.leader')
    @includeIf('front.cache.career.not-sure')
    @includeIf('front.cache.career.life-here')
    @includeIf('front.cache.career.internship')
@endsection
