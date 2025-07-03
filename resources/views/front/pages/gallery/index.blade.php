@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.gallery.index')
@endsection

@section('content')
   @includeIf('front.cache.gallery.index')
@endsection
