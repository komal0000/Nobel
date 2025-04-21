@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.treatment')
@endsection

@section('content')
@includeIf('front.cache.treatment.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/treatment/index.js') }}" ></script>
@endsection
