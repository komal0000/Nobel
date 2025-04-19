@extends('front.layout.app')

@section('title', 'All Ailments | Nobel Hospital')

@section('meta_title', 'All Ailments | Nobel Hospital')
@section('meta_description', 'All Ailments section available in Nobel Hospital')
@section('meta_keywords', 'ailments')

@section('content')
    @includeIf('front.cache.aliment.index')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/aliment/index.js') }}"></script>
@endsection
