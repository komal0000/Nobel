@extends('front.layout.app')
@section('title', $speciality->title.' | Nobel Hospital')

@section('meta_title', $speciality->title.' | Nobel Hospital')
@section('meta_description', $speciality->short_description)
@section('meta_keywords', $speciality->title)

@section('content')
    @includeIf('front.cache.speciality.single.' . $id . '.overview')
    @includeIf('front.cache.speciality.single.' . $id . '.message')
    @includeIf('front.cache.speciality.single.' . $id . '.team')
    @includeIf('front.cache.speciality.single.' . $id . '.treatment')
    @includeIf('front.cache.speciality.single.' . $id . '.aliment')
    @includeIf('front.cache.speciality.single.' . $id . '.technologies')
    @includeIf('front.cache.speciality.single.' . $id . '.subspecialization')
    @includeIf('front.cache.speciality.single.' . $id . '.story')
    @includeIf('front.cache.speciality.single.' . $id . '.know-more')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/speciality/single.js') }}"></script>
@endsection
