@extends('front.layout.app')
@section('metaData')
   @includeIf('front.cache.meta.career.job.' . $slug)
@endsection

@section('content')
   @includeIf('front.cache.career.job.' . $slug)
@endsection