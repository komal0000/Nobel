@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.contact')
@endsection

@section('content')
    @includeIf('front.cache.contact.index')
    @includeIf('front.cache.contact.map')
@endsection
@section('js')

@endsection
