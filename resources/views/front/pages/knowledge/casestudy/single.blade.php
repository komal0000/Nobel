@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.knowledge.casestudy.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.knowledge.casestudy.' . $slug);
@endsection