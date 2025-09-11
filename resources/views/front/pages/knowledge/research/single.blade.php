@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.knowledge.research.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.knowledge.research.' . $slug);
@endsection