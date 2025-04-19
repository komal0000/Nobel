@extends('front.layout.app')
@section('title', $ailment->title)
@section('meta', $ailment->title.' Page')
@section('content')
    @includeIf('front.cache.aliment.single.'.$id)
@endsection
@section('js')
    <script>
        toggleSectionNav(true);
    </script>
@endsection
