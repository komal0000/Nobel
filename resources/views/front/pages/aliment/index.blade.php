@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.ailment')
@endsection

@section('content')
    @includeIf('front.cache.aliment.index')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/aliment/index.js') }}"></script>
@endsection
