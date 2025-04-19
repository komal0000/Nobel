@extends('front.layout.app')

@section('title', 'All Technologies | Nobel Hospital')

@section('meta_title', 'All Technologies | Nobel Hospital')
@section('meta_description', 'All Technologies section available in Nobel Hospital')
@section('meta_keywords', 'technologies')

@section('content')
@includeIf('front.cache.technology.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/technology/index.js') }}" ></script>
@endsection
