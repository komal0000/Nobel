@extends('front.layout.app')

@section('title', $casestudy->title)
@section('meta', $casestudy->title.' Page')

@section('content')
@includeIf('front.cache.knowledge.casestudy.'.$casestudy_id);
@endsection
