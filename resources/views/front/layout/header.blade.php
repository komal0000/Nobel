<header class="site-header" id="site-header">
    <div class="main-container">
        <a href="/"><img src="{{ asset('front/img/logo.png') }}" class="logo" alt=""></a>
        <nav class="navbar navbar-expand p-0" id="navbar">
            <div class="">
                <ul class="nav-ul">
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link" >
                            Locations <x-down class="down-icon"></x-down>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="#" class="drop-item">Location 1</a>
                            </li>
                            <li>
                                <a href="#" class="drop-item">Location 2</a>
                            </li>
                            <li>
                                <a href="#" class="drop-item">Location 3</a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link" >
                            Speciality <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="/speciality" class="drop-item">Speciality 1</a>
                            </li>
                            <li>
                                <a href="/speciality" class="drop-item">Speciality 2</a>
                            </li>
                            <li>
                                <a href="/speciality" class="drop-item">Speciality 3</a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link" >
                            Health Library <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="#" class="drop-item">Health Library 1</a>
                            </li>
                            <li>
                                <a href="#" class="drop-item">Health Library 2</a>
                            </li>
                            <li>
                                <a href="#" class="drop-item">Health Library 3</a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link" >
                            Services <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="#" class="drop-item">Services 1</a>
                            </li>
                            <li>
                                <a href="#" class="drop-item">Services 2</a>
                            </li>
                            <li>
                                <a href="#" class="drop-item">Services 3</a>
                            </li>
                        </ul>
                    </li>
                    <li class="navbar-item">
                        <a href="/career" class="navbar-link ">Career</a>
                    </li>
                    <li class="navbar-item" onclick="extendSubMenu(this)">
                        <a href="#" class="navbar-link" >
                            Contact Us <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul class="drop-menu">
                            <li>
                                <a href="mailto:hello@example.com" class="drop-item">Mail</a>
                            </li>
                            <li>
                                <a href="tel:+9779876543210" class="drop-item">number</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="feedback-contact d-flex">
            <a href="#" class="feedback-btn navbar-link">
                <img src="{{ asset('front/img/write-message.png') }}" class="feedback-image" alt="Feedback">
            </a>
            <a href="#" class="whatsapp-link">
                <img src="{{ asset('front/img/whatsapp.png') }}" alt="WhatsApp" class="whatsapp-image">
                <span>WhatsApp</span>
            </a>
            <a class="emergency-btn" href="tel:1068">
                <img src="{{ asset('front/img/emergency.png') }}" alt="Emergency" width="50" height="50">
            </a>
            <a class="md-emergency-btn" href="tel:1068">
                <img src="{{ asset('front/img/emergency.png') }}" alt="Emergency" width="50" height="50">
                <span>Emergency</span>
            </a>

            <button href="#" class="call-back navbar-link" data-bs-toggle="modal" data-bs-target="#resume-modal">
                <img src="{{ asset('front/img/phone-icon.png') }}" alt="Call Back" class="call-back-image me-1">
                <small>Request Call Back</small>
            </button>
            <a href="#" class="md-contact-us">
                <img src="{{ asset('front/img/phone-grey-icon.png') }}" alt="Call Back" class="call-back-image me-1">
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
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Full Name *" required>
                                <label for="name">Full Name *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" name="phoneNumber" placeholder="Phone Number *" required>
                                <label for="phoneNumber">Phone Number *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email Address *" required>
                                <label for="email" >Email
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
@push('js')
    <script>
            function extendSubMenu(el) {
                if($(el).hasClass('active-list')) {
                    $(el).removeClass('active-list');
                    return;
                }
                $('.navbar-item').removeClass('active-list');

               $(el).toggleClass('active-list');
               event.preventDefault();
            }
    </script>
@endpush
