@extends('front.layout.app')
@section('title', $technology->title . ' | Nobel Hospital')

@section('meta_title', $technology->title . ' | Nobel Hospital')
@section('meta_description', $technology->short_description)
@section('meta_keywords', $technology->title)

@section('content')
@includeIf('front.cache.technology.single.' . $id)
@endsection
@section('js')
 <script src="{{ asset('front/assets/js/technology/single.js')}}"  ></script>
@endsection
