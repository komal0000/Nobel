@extends('front.layout.app')

@section('title', $event->title)
@section('meta', $event->title.' Page')

@section('content')
@includeIf('front.cache.event.single.'.$event_id);
@endsection
