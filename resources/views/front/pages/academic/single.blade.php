@extends('front.layout.app')

@section('title', '')

@section('meta_title', 'Academic Name | Nobel Hospital')
@section('meta_description', 'Academic Name of Nobel Hospital')
@section('meta_keywords', 'academic, nobel academic')

@section('content')
    @includeIf('front.cache.academic.single.' . $academic_id)
@endsection
