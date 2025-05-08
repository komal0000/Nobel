@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.technology.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.technology.single.' . $slug)
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/technology/single.js')}}"></script>
@endsection