@extends('front.layout.app')

@section('title', 'Update Name')
@section('meta', 'Update Name page for the website')

@section('content')
@includeIf('front.cache.home.update.'.$update_id);
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
