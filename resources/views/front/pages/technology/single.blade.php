@extends('front.layout.app')
@section('title', $technology->title)
@section('meta', $technology->title.' Page')
@section('content')
@includeIf('front.cache.technology.single.'.$id)
@endsection
@section('js')
 <script src="{{ asset('front/assets/js/technology/single.js' )}}"  ></script>
@endsection
