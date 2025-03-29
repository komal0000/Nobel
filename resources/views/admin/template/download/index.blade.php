@extends('front.layout.app')

@section('title', 'Events & News')
@section('meta', 'Events & News page for the website')

@section('content')
    <section id="downloads">
        <div class="main-container">
            <div class="tabs-container mb-4">
                <button class="tab active">All</button>
                @foreach ($downloadMainTypes as $type)
                    <button class="tab">{{ $type->name }}</button>
                @endforeach
            </div>
            <div class="row content-row">
                <div class="col-md-4 filter-desktop">
                    <div class="form-floating mb-4">
                        <input type="text" name="name" class="form-control" placeholder="Search">
                        <label for="name">Search</label>
                        <div class="search-icon"><i class="bi bi-search"></i></div>
                    </div>
                    <div class="filter-list">
                        <ul>

                        </ul>
                    </div>
                </div>
                <div class="col-md-8 content-col">
                    <div class="row g-3 card-row">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="col-md-6 col-xl-4">
                                <div class="download-card" data-bs-target="#disease-modal">
                                    <div class="img-wrapper">
                                        <img src="{{ asset('front/img/service-img.jpg') }}" alt="Service Image"
                                            class="w-100 img-fluid">
                                        <div class="logo d-flex justify-content-between">
                                            <a class="z-1" href="#" target="_blank">
                                                <i class="bi bi-file-earmark"></i>
                                            </a>
                                            <div class="end d-flex gap-3">
                                                <a class="z-1" href="#">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a class="z-1" href="#">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="body">
                                        <h3 class="title heading-sm mb-2">Title</h3>
                                        <div class="para-wrap date">12/12/2081</div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="modal" tabindex="-1" id="disease-modal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <div class="modal-title heading-md">
                                    Disease Name
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <button class="modal-body-btn">View PDF</button>
                                <button class="modal-body-btn">Download PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.download-card').click(function(e) {
                if (!$(e.target).closest('a').length) {
                    $('#disease-modal').modal('show');
                }
            });
        })
        $('.tab').click(function() {
            console.log('click');

            $('.tab').removeClass('active');
            $(this).addClass('active');
        })
    </script>
@endpush
