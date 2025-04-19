@extends('front.layout.app')
@section('title', $ailment->title.' | Nobel Hospital')

@section('meta_title', $ailment->title . ' | Nobel Hospital')
@section('meta_description', $ailment->short_description)
@section('meta_keywords', $speciality->title)

@section('content')
    @includeIf('front.cache.aliment.single.' . $id)
@endsection
@section('js')
    <script>
        toggleSectionNav(true);
    </script>
@endsection
