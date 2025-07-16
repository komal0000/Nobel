@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.admission')
@endsection
@section('content')
    @includeIf('front.cache.admission.index')
@endsection