
@extends('front.layout.app')

@section('title', 'All Ailments')
@section('meta', 'All Ailments page for the website')

@section('content')
 @includeIf('front.cache.aliment.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/aliment/index.js') }}" ></script>
@endsection
