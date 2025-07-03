@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.gallery.' . $slug)
@endsection

@section('content')
   @includeIf('front.cache.gallery.' . $slug)
@endsection
@section('js')
   <script>
       const lightbox = GLightbox({ selector: '.glightbox' });
   </script>
@endsection
