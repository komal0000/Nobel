@extends('front.layout.app')

@section('title', 'Academic')
@section('meta', 'Academic page for the website')

@section('content')
    @includeIf('front.cache.academic.index');
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/video/index.js') }}"></script>
@endsection
