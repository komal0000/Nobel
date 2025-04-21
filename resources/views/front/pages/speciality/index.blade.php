@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.speciality')
@endsection

@section('content')
@include('front.cache.speciality.index')
@endsection
@section('js')
<script src="{{ asset('front/assets/js/speciality/index.js') }}" ></script>
@endsection
