@extends('front.layout.app')

@section('title', 'Academic | Nobel Hospital')

@section('meta_title', 'Academic | Nobel Hospital')
@section('meta_description', 'Academic section of Nobel Hospital')
@section('meta_keywords', 'academic, nobel academic')

@section('content')
    @includeIf('front.cache.academic.index');
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/video/index.js') }}"></script>
@endsection
