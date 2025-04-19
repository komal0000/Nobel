@extends('front.layout.app')

@section('title', $doctor->title)
@section('meta', $doctor->title.' page for the website')

@section('content')
    @includeIF('front.cache.doctor.single.'.$doctor_id)
    @includeIF('front.cache.doctor.videos.'.$doctor_id)
@endsection
@section('js')
 <script src="{{ asset('front/assets/js/doctor/single.js') }}" ></script>
@endsection
