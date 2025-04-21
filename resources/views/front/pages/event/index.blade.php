@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.event.event')
@endsection


@section('content')
    @includeIf('front.cache.event.index')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/event/index.js') }}"></script>
@endsection