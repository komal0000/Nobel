@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.academic.academic')
@endsection

@section('content')
    @includeIf('front.cache.academic.index');
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/video/index.js') }}"></script>
@endsection
