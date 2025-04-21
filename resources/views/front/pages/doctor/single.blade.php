@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.doctor.'.$slug)
@endsection

@section('content')
    @includeIF('front.cache.doctor.single.' . $doctor->id)
    @includeIF('front.cache.doctor.videos.' . $doctor->id)
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/doctor/single.js') }}"></script>
@endsection
