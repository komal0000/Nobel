@extends('front.layout.app')

@section('title', 'Events')
@section('meta', '')

@section('content')
@includeIf('front.cache.event.single.'.$event_id);
@endsection
