@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.speciality.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.speciality.single.' . $slug . '.overview')
    @includeIf('front.cache.speciality.single.' . $slug . '.message')
    @includeIf('front.cache.speciality.single.' . $slug . '.team')
    @includeIf('front.cache.speciality.single.' . $slug . '.treatment')
    @includeIf('front.cache.speciality.single.' . $slug . '.aliment')
    @includeIf('front.cache.speciality.single.' . $slug . '.technologies')
    @includeIf('front.cache.speciality.single.' . $slug . '.subspecialization')
    @includeIf('front.cache.speciality.single.' . $slug . '.story')
    @includeIf('front.cache.speciality.single.' . $slug . '.know-more')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/speciality/single.js') }}"></script>
@endsection