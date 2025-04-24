@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.academic.'.$slug)
@endsection

@section('content')
    @includeIf('front.cache.academic.single.' . $slug)
@endsection
