@extends('front.layout.app')

@section('title', 'Events & News | Nobel Hospital')

@section('meta_title', 'Events & News | Nobel Hospital')
@section('meta_description', 'All Events & News available in Nobel Hospital')
@section('meta_keywords', 'event, news')


@section('content')
@includeIf('front.cache.event.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/event/index.js') }}"></script>
@endsection
