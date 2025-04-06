@extends('front.layout.app')

@section('title', '')
@section('meta', '')

@section('content')
    @includeIf('front.cache.academic.single.'.$academic_id)
@endsection
