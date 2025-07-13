@section('css')
    <style>
        #int-banner .tab {
            display: flex;
            align-items: center;
            box-shadow: 0 4px 40px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 16px 60px 16px 25px;
            background-color: #fff;
            position: relative;
            font-size: 14px;
            font-weight: 700;
            transition: 0.2s ease;
        }
    </style>
@endsection
<section id="videos-top-banner">
    <picture class="img-wrap">
        <source media="(min-width: 768px)" srcset="{{ asset('front/assets/img/academic.webp') }}" width="1920"
            height="500" alt="video">
        <source media="(min-width: 320px)" srcset="{{ asset('front/assets/img/academic-md.jpg') }}" width="480"
            height="320" alt="video">
        <img src="{{ asset('front/assets/img/academic.webp') }}" width="1920" height="500" alt="video"
            class="img-fluid w-100">
        <div class="banner-title text-center px-2">Academic Program</div>
    </picture>
</section>
@php
    $data =
        App\Helper::getSetting('intContact') ??
        ((object) [
            'phone' => '',
            'email' => '',
            'short_desc' => '',
            'image' => '',
        ]);
    $phones = explode(',', $data->phone);
    $emails = explode(',', $data->email);
@endphp

@isset($data)
    <section id="int-banner">
        <div class="main-container">
            <div class="heading-group">
                <div class="heading">{{$data->title}}</div>
            </div>
            <div class="content-wrapper">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="custom-tabs-desktop">
                            <ul class="list-unstyled">
                                <li class=" mb-3">
                                    <div class="tab d-flex">
                                        <div class="logo align-self-center">
                                            <i class="bi bi-telephone-fill"></i>
                                        </div>
                                        <div class="phoneNumbers p-2">
                                            @foreach ($phones as $key => $phone)
                                                @if (!empty($phone))
                                                    <div class="mb-0">{{ $phone }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </li>
                                <li class="">

                                    <div class="tab d-flex">
                                        <div class="logo align-self-center">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div class="emails p-2">
                                            <div class="email">
                                                @foreach ($emails as $key => $email)
                                                @if (!empty($email))
                                                    <a href="mailto:{{$email}}" class="mb-0">{{ $email }}</a>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-lg-8">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="desc para-wrap">{{ $data->short_desc ?? '' }}</div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="img-wrap square-image">
                                    <img src="{{ asset($data->image) ?? '' }}" class="img-fluid w-100 object-fit-cover rounded-2"
                                        alt="Contact Information">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endisset

@foreach ($academicProgramTypes as $type)
    <section id="doctor-videos" data-content="Doctor Videos">
        <div class="main-container">
            <div class="heading-group">
                <div class="heading text-center">{{ $type->title }}</div>
                <x-hoverBtn class="button" href="{{ route('academicprogram.list') }}">View All</x-hoverBtn>
            </div>
            @php
                $academicPrograms = App\Models\Blog::where('blog_category_id', $type->id)->get();
            @endphp
            <div class="doctor-slider">
                @foreach ($academicPrograms as $academicProgram)
                    <a href="{{ route('academicprogram.single', ['slug' => $academicProgram->slug]) }}">
                        <div class="video-card doctor-card">
                            <div class="img-wrapper">
                                <img src="{{ asset($academicProgram->image) }}" alt="Staff">
                            </div>
                            <div class="body">
                                <div class="heading-sm">
                                    {{ $academicProgram->title }}
                                </div>
                                <div class="para-wrap">
                                    {{ $academicProgram->short_description }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mobile-btn">
                <x-hoverBtn href="{{ route('academicprogram.list') }}">View All</x-hoverBtn>
            </div>
        </div>
    </section>
@endforeach
