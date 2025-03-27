@extends('front.layout.app')
@section('title', 'Technology Name')
@section('meta', 'Technology-Name page for the website')
@section('content')
@includeIf('front.cache.technology.single.'.$id)
@endsection
@section('js')
 <script src="{{ asset('front/assets/js/technology/single.js' )}}"  ></script>
@endsection
