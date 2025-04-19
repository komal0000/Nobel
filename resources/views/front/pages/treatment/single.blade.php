@extends('front.layout.app')

@section('title', $treatment->title)
@section('meta', $treatment->title.' Page')

@section('content')
    @includeIf('front.cache.treatment.single.' . $id)
@endsection


@section('js')
    <script src="{{ asset('front/assets/js/treatment/single.js') }}"></script>
@endsection
