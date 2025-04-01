@extends('front.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="modal fade" id="homepageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="w-100 img-fluid" src="{{ asset('front/img/modal-test.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    @include('front.pages.home.slider')
    @include('front.pages.home.speciality')
    @include('front.pages.home.team')
    @includeIf('front.cache.home.care')
    @includeIf('front.cache.home.services')
    @includeIf('front.cache.home.videos')
    @includeIf('front.pages.home.national')
    @includeIf('front.cache.home.updates')
    @includeIf('front.cache.home.awards')
    @includeIf('front.cache.home.newsEvent')
@endsection
@section('js')
    <script src="{{ asset('front/assets/js/home/index.js') }}"></script>
@endsection
