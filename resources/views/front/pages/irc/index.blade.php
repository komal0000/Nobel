@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.irc')
@endsection
@section('content')
    @includeIf('front.cache.irc.index')
@endsection