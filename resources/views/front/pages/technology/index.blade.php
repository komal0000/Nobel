@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.technology')
@endsection

@section('content')
@includeIf('front.cache.technology.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/technology/index.js') }}" ></script>
@endsection
