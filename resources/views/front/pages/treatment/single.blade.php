@extends('front.layout.app')

@section('title', 'Treatment Name')
@section('meta', 'Treatment-Name page for the website')

@section('content')
    @includeIf('front.cache.treatment.single.' . $id)
@endsection

{{-- maile haleko --}}
@section('js')
    <script src="{{ asset('front/assets/js/treatment/single.js') }}"></script>
@endsection
