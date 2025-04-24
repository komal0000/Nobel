@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.event.'.$slug)
@endsection

@section('content')
@includeIf('front.cache.event.single.' . $slug);
@endsection
