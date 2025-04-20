@extends('front.layout.app')

@section('title', $casestudy->title.' | Nobel Hospital')

@section('meta_title', $casestudy->title . ' | Nobel Hospital')
@section('meta_description', $casestudy->short_description)
@section('meta_keywords', $casestudy->title)
@section('og_image', asset('storage/'.$casestudy->image))

@section('content')
@includeIf('front.cache.knowledge.casestudy.' . $casestudy->id);
@endsection
