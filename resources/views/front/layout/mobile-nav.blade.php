<div class="mobile-sticky-link d-xl-none">

    <ul class="">
        <li>
            <button class="toggle-menu" href="#" id="toggle-navbar">
                <div class="icon open-icon">
                    <img src="{{ asset('front/assets/img/hamburger-menu.svg') }}" alt="Menu">
                </div>
                <div class="icon close-icon d-none">
                    <img src="{{ asset('front/assets/img/close.svg') }}" alt="Close">
                </div>
                Menu
            </button>
        </li>
        <li>
            <a href="{{ route('doctor.index') }}">
                <div class="icon">
                    <img src="{{ asset('front/assets/img/doctor.svg') }}" alt="Doctor">
                </div>
                Doctor
            </a>
        </li>
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#callback-modal">
                <div class="icon">
                    <img src="{{ asset('front/assets/img/call.svg') }}" alt="Call">
                </div>
                Call Back
            </a>
        </li>

    </ul>

</div>

