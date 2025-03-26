@extends('front.layout.app')

@section('title', 'All Specialities')
@section('meta', 'All Specialities page for the website')

@section('content')
@includeIf('front.cache.speciality.index')
@endsection
