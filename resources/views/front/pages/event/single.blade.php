@extends('front.layout.app')

@section('title', $event->title.' | Nobel Hospital')

@section('meta_title', $event->title . ' | Nobel Hospital')
@section('meta_description', $event->short_description)
@section('meta_keywords', $event->title)
@section('og_image', asset('storage/' . $event->image))

@section('content')
@includeIf('front.cache.event.single.' . $event->id);
@endsection
