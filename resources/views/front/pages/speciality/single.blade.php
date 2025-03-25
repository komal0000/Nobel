@extends('front.layout.app')
@section('title', 'Speciality')
@section('meta', 'Speciality page')
@section('content')
    @includeIf('front.cache.speciality.single.'.$id.'.overview')
    @includeIf('front.cache.speciality.single.'.$id.'.message')
    @includeIf('front.cache.speciality.single.'.$id.'.team')
    @includeIf('front.cache.speciality.single.'.$id.'.treatment')
    @includeIf('front.cache.speciality.single.'.$id.'.aliment')
    @includeIf('front.cache.speciality.single.'.$id.'.technologies')
    @includeIf('front.cache.speciality.single.'.$id.'.sub-specialization')
    @includeIf('front.cache.speciality.single.'.$id.'.story')
    @includeIf('front.cache.speciality.single.'.$id.'.know-more')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/speciality/single.js') }}"></script>
@endsection
