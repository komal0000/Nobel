@extends('front.layout.app')
@section('title', 'Ailment Name')
@section('meta', 'Ailment-Name page for the website')
@section('content')
    @includeIf('front.cache.aliment.single.'.$id)
@endsection
@section('js')
    <script>
        toggleSectionNav(true);
    </script>
@endsection
