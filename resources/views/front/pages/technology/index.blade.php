@extends('front.layout.app')

@section('title', 'All Technologies')
@section('meta', 'All TEchnologies page for the website')

@section('content')
@includeIf('front.cache.technology.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/technology/index.js') }}" ></script>
@endsection
