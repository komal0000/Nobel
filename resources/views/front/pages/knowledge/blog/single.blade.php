@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.knowledge.blog.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.knowledge.blog.' . $slug);
@endsection