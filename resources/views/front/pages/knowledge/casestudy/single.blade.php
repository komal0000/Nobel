@extends('front.layout.app')

@section('title', 'Case Study Name')
@section('meta', 'Case Study Name page for the website')

@section('content')
@includeIf('front.cache.knowledge.casestudy.'.$casestudy_id);
@endsection
