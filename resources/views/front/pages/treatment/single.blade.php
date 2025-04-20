@extends('front.layout.app')

@section('title', $treatment->title.' | Nobel Hospital')

@section('meta_title', $treatment->title . ' | Nobel Hospital')
@section('meta_description', $treatment->short_description)
@section('meta_keywords', $treatment->title)

@section('content')
    @includeIf('front.cache.treatment.single.' . $treatment->id)
@endsection


@section('js')
    <script src="{{ asset('front/assets/js/treatment/single.js') }}"></script>
@endsection
