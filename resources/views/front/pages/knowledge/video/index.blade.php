@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.knowledge.video')
@endsection


@section('content')
@includeIf('front.cache.knowledge.video');
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/video/index.js') }}"></script>
@endsection
