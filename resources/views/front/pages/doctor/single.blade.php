@extends('front.layout.app')

@section('title', $doctor->title . ' | Nobel Hospital')

@section('meta_title', $doctor->title . ' | Nobel Hospital')
@section('meta_description', $doctor->short_description)
@section('meta_keywords', $doctor->title)
@section('og_image', Storage::url($doctor->image))

@section('content')
    @includeIF('front.cache.doctor.single.'.$doctor->id)
    @includeIF('front.cache.doctor.videos.'.$doctor->id)
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/doctor/single.js') }}"></script>
@endsection
