@extends('front.layout.app')

@section('title', 'Events & News')
@section('meta', 'Events & News page for the website')

@section('content')
@includeIf('front.cache.event.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/event/index.js') }}"></script>
@endsection
