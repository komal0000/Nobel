@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.home.update.'.$slug)
@endsection

@section('content')
@includeIf('front.cache.home.update.'. $slug);
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            const lightBox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true
            });
        });
    </script>
@endsection
