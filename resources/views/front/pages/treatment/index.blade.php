@extends('front.layout.app')

@section('title', 'All Treatments')
@section('meta', 'All Treatments page for the website')

@section('content')
@includeIf('front.cache.treatment.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/treatment/index.js') }}" ></script>
@endsection
