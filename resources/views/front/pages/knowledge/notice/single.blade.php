@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.knowledge.notice.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.knowledge.notice.' . $slug);
@endsection