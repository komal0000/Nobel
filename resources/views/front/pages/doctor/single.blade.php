@extends('front.layout.app')

@section('title', 'Doctor Profile')
@section('meta', 'Per Doctor page for the website')

@section('content')
    @includeIF('front.cache.doctor.single.'.$doctor_id)
    @includeIF('front.cache.doctor-profile.dr-about')
    @includeIF('front.cache.doctor-profile.dr-specialization')
    @includeIF('front.cache.doctor-profile.dr-milestone')
    @includeIF('front.cache.doctor-profile.dr-article')
    @includeIF('front.cache.doctor-profile.dr-media')
@endsection
