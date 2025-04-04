@php
    $data =
        App\Helper::getSetting('contact') ??
        (object) [
            'email' => '',
            'phone' => '',
        ];
@endphp
<header class="site-header" id="site-header">
    <div class="main-container">
        @includeIf('front.cache.home.logo')
        <nav class="navbar navbar-expand p-0" id="navbar">
            <div class="">
                <ul class="nav-ul">
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Speciality <i class="bi bi-chevron-down"></i>
                        </a>
                        @includeIf('front.cache.home.header')
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Health Library <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="{{ route('healthlibrary.index') }}" class="drop-item">Health Library</a>
                            </li>
                            <li>
                                <a href="{{ route('treatment.index') }}" class="drop-item">Treatments</a>
                            </li>
                            <li>
                                <a href="{{ route('technology.index') }}" class="drop-item">Technologies</a>
                            </li>
                            <li>
                                <a href="{{ route('aliment.index') }}" class="drop-item">Ailments</a>
                            </li>
                            <li class="navbar-item knowledge-drop" onclick="extendKnowledgeSubMenu(this, event)">
                                <a href="#" class="drop-item navbar-link knowledge-link d-flex justify-content-between">
                                    <span>Knowledge</span> <i class="bi bi-chevron-right"></i>
                                </a>
                                <ul class="knowledge-drop-menu">
                                    <li>
                                        <a href="{{ route('knowledge.blog') }}" class="drop-item">Blogs</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('knowledge.video') }}" class="drop-item">Videos</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('knowledge.caseStudy') }}" class="drop-item">Case Studies</a>
                                    </li>
                                    <li>
                                        <a href="/news-letter" class="drop-item">News Letter</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('event') }}" class="drop-item">Events</a>
                            </li>
                            <li>
                                <a href="{{ route('download.index') }}" class="drop-item">Downloads</a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Services <i class="bi bi-chevron-down"></i>
                        </a>
                        @includeIf('front.cache.home.headerService')
                    </li>
                    <li class="navbar-item">
                        <a href="{{ route('careers') }}" class="navbar-link ">Career</a>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link">
                            Contact Us <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="{{ route('contact') }}" class="drop-item">Contact Us</a>
                            </li>
                            <li>
                                <a href="mailto:{{ $data->email }}" class="drop-item">{{ $data->email }}</a>
                            </li>
                            <li>
                                <a href="tel:+977 {{ $data->phone }}" class="drop-item">{{ $data->phone }}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="feedback-contact d-flex">
            <a href="{{ route('contact') }}" class="feedback-btn navbar-link">
                <img src="{{ asset('front/assets/img/write-message.png') }}" class="feedback-image" alt="Feedback">
            </a>
            <a href="#" class="whatsapp-link">
                <img src="{{ asset('front/assets/img/whatsapp.png') }}" alt="WhatsApp" class="whatsapp-image">
                <span>WhatsApp</span>
            </a>
            <button class="call-back navbar-link" data-bs-toggle="modal"
                data-bs-target="#resume-modal">
                <img src="{{ asset('front/assets/img/phone-icon.png') }}" alt="Call Back" class="call-back-image me-1">
                <small>Request Call Back</small>
            </button>
            <a href="#" class="md-contact-us">
                <img src="{{ asset('front/assets/img/phone-grey-icon.png') }}" alt="Call Back" class="call-back-image me-1">
                <span>Contact</span>
            </a>
        </div>
    </div>
</header>
<div class="modal fade " id="resume-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header p-0 pb-3 border-bottom-0">
                <h2 class="modal-title heading-md text-center">Request Call Back</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.setting.requestCallBack') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Full Name *"
                                required>
                            <label for="name">Full Name *</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" name="phoneNumber"
                                placeholder="Phone Number *" required>
                            <label for="phoneNumber">Phone Number *</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email Address *"
                                required>
                            <label for="email">Email
                                Address *</label>
                        </div>
                    </div>
                    <div class="col-12 submit-btn">
                        <button class="w-100" id="submit-callback">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

