@extends('front.layout.app')

@section('title', 'All Specialities')
@section('meta', 'All Specialities page for the website')

@section('content')
@include('front.cache.speciality.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/home/index.js') }}" ></script>
@endsection
