@extends('front.layout.app')

@section('metaData')
   @includeIf('front.cache.meta.aliment.'.$slug) 
@endsection

@section('content')
    @includeIf('front.cache.aliment.single.' . $slug)
@endsection
@section('js')
    <script>
        toggleSectionNav(true);
    </script>
@endsection
