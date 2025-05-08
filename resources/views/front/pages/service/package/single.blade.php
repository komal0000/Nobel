@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.service.' . $serviceSlug . '.package.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.service.' . $serviceSlug . '.package.' . $slug)
@endsection

@section('js')
<script>
        toggleBreadcrumbs(true);
        $('#single-package-overview .read-more-btn').on('click', function() {
            $('#single-package-overview').find('.content-wrapper').toggleClass('active');
        })
    </script>
@endsection