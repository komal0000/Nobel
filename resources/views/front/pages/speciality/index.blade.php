@extends('front.layout.app')

@section('title', 'All Specialities | Nobel Hospital')

@section('meta_title', 'All Speciality | Nobel Hospital')
@section('meta_description', 'Nobel is the best hospital in Nepal located in Biratnagar with multi-specialties and sub-specialities sections.')
@section('meta_keywords', 'specialities, cardiac care, cancer care')

@section('content')
@include('front.cache.speciality.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/speciality/index.js') }}" ></script>
@endsection
