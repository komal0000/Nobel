@extends('front.layout.app')

@section('title', 'All Treatments | Nobel Hospital')

@section('meta_title', 'All Treatments | Nobel Hospital')
@section('meta_description', 'All Treatments section available in Nobel Hospital')
@section('meta_keywords', 'ailments')

@section('content')
@includeIf('front.cache.treatment.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/treatment/index.js') }}" ></script>
@endsection
