<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/core/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/dist/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hope-ui.min.css?v=5.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.min.css?v=5.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.min.css?v=5.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rtl.min.css?v=5.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css?v=5.0.0') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
        .card-title a {
            color: #232D42;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease-in-out, text-shadow 0.3s ease-in-out;
        }
        .dropify-wrapper {
            font-size: 16px !important;
            /* Adjust as needed */
        }

        .dropify-message span {
            font-size: 16px !important;
            /* Text insie Dropify */
        }

        .dropify-clear {
            font-size: 16px !important;
            /* Remove button text */
        }
    </style>
    @yield('css')
</head>
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body">
        </div>
    </div>
    @include('admin.layout.sidebar')
    <div class="main-content">
        @include('admin.layout.navbar')
        @if (!request()->routeIs('admin.index'))
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
                    <div class="card mb-2">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-title" style="margin: 0px">
                                <div class="bd-example">
                                    <nav aria-label="breadcrumb" >
                                        <ol class="breadcrumb" style="margin: 0px;font-size: 20px">
                                            <li class="breadcrumb-item"> @yield('title')</li>

                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            <div class="card-action">
                                @yield('btn')
                            </div>
                        </div>
                    </div>
                    <div class="card  ">
                        <div class="card-body">
                            @include('admin.layout.flash')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script src="{{ asset('assets/js/core/libs.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/external.min.js') }}"></script>
    <script src="{{ asset('assets/js/hope-ui.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a file here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happened.'
                }
            });
        });
    </script>

    @yield('js')
</div>

</html>
