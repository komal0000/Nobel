@php
    $data =
        App\Helper::getSetting('contact') ??
        (object) [
            'map' => '',
            'email' => '',
            'addr' => '',
            'short_desc' => '',
            'links' => (object) [
                'facebook' => '',
                'youtube' => '',
                'instagram' => '',
                'twitter' => '',
            ],
        ];

    $phones =
        is_array($data->phone) || is_object($data->phone)
            ? (object) $data->phone
            : (object) [
                'phone1' => '',
                'phone2' => '',
                'phone3' => '',
                'phone4' => '',
            ];

    $intData =
        App\Helper::getSetting('internationalContact') ??
        (object) [
            'email' => '',
            'phone' => '',
            'short_desc' => '',
            'image' => '',
        ];
    $intPhone = explode(',', $intData->phone);
    $emails = explode(',', $intData->email);
@endphp
<div class="mob-back-img">
    <img src="{{ asset('front/assets/img/contact-us/contact-banner-xs.jpg') }}" alt="Mobile Background Image"
        class="img-fluid w-100">
    <div class="banner-title">
        Contact Us
    </div>
</div>
<section class="contact"
    style="background-image: url('{{ asset('front/assets/img/contact-us/contact-banner-lg.jpg') }}');">
    <div class="main-container">
        <div class="heading-group mb-5">
            <div class="heading text-center mb-3">Contact Us</div>
            <div class="text-center para-wrap">
                <p>{{ $data->short_desc }}</p>
            </div>
        </div>
        <div class="form-container p-4">
            <div class="row g-4 justify-content-evenly">
                <div class="detail col-lg-4 p-0 pb-4">
                    <div class="heading-md p-4">Contact Details</div>
                    <div class="first for-border d-flex gap-3 w-100 px-4 pb-2">
                        <div class="logo align-self-center">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="info">
                            <div class="head">Phone Number</div>
                            @foreach ($phones as $key => $phone)
                                @if (!empty($phone))
                                    <div class="mb-0">{{ $phone }}</div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="first for-border d-flex gap-3 w-100 px-4 py-2">
                        <div class="logo align-self-center">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="info">
                            <div class="head">International Contact</div>
                            @if (!empty($intPhone))
                                @foreach ($intPhone as $intP)
                                    <div class="mb-0">{{ $intP }}</div>
                                @endforeach
                            @endif
                            @if ($intData->email)
                                @foreach ($emails as $email)
                                <span class="para-wrap fw-semibold">Email: </span><a href="mailto:{{ $email }}"
                                    class="mb-0">{{ $email }}</a>
                                    
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="first d-flex gap-3 px-4 pt-2">
                        <div class="logo align-self-center">
                            <i class="bi bi-share-fill"></i>
                        </div>
                        <div class="info border-bottom-1">
                            <div class="head">Follow Us</div>
                            <div class="socials d-flex gap-3">
                                <a href="{{ $data->links->facebook }}" target="_blank"><i
                                        class="bi bi-facebook"></i></a>
                                <a href="{{ $data->links->instagram }}" target="_blank"><i
                                        class="bi bi-instagram"></i></a>
                                <a href="{{ $data->links->youtube }}" target="_blank"><i class="bi bi-youtube"></i></a>
                                <a href="{{ $data->links->twitter }}" target="_blank"><i
                                        class="bi bi-twitter-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="feedback-form" class="form col-lg-7" action="{{ route('addFeedback') }}" method="POST">
                    @csrf
                    <div class="heading-md mb-4">Feedback</div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name">Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Your Name"
                                required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email">Email Address *</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your E-mail"
                                required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="phoneNumber">Mobile Number *</label>
                            <input type="text" name="phoneNumber" class="form-control"
                                placeholder="Enter Your Phone Number" required>
                        </div>
                        <div class=" mb-3 col-12">
                            <label for="message">Your Message *</label>
                            <textarea name="message" class="form-control" placeholder="Enter your Message here" required></textarea>
                        </div>
                    </div>
                    <div class="button align-self-center">
                        <button type="submit" class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
