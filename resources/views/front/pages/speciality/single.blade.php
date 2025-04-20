@extends('front.layout.app')
@section('title', $speciality->title.' | Nobel Hospital')

@section('meta_title', $speciality->title.' | Nobel Hospital')
@section('meta_description', $speciality->short_description)
@section('meta_keywords', $speciality->title)

@section('content')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.overview')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.message')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.team')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.treatment')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.aliment')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.technologies')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.subspecialization')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.story')
    @includeIf('front.cache.speciality.single.' . $speciality->id . '.know-more')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/speciality/single.js') }}"></script>
@endsection
