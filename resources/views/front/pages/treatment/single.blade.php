@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.treatment.'.$slug)
@endsection

@section('content')
    @includeIf('front.cache.treatment.single.' . $treatment->id)
@endsection


@section('js')
    <script src="{{ asset('front/assets/js/treatment/single.js') }}"></script>
@endsection
