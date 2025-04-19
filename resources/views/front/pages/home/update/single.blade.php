@extends('front.layout.app')

@section('title', $update->title.' | Nobel Hospital')

@section('meta_title', $update->title . ' | Nobel Hospital')
@section('meta_description', $update->short_description)
@section('meta_keywords', $update->title)
@section('og_image', asset('storage/' . $update->image))

@section('content')
@includeIf('front.cache.home.update.' . $update_id);
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
