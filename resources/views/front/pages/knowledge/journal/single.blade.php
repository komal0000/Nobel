@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.knowledge.journal.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.knowledge.journal.' . $slug);
@endsection