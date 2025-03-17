<div class="mobile-sticky-link d-xl-none">

    <ul class="">
        <li>
            <button class="toggle-menu" href="#" id="toggle-navbar">
                <div class="icon open-icon">
                    <img src="{{ asset('front/img/hamburger-menu.svg') }}" alt="Menu">
                </div>
                <div class="icon close-icon d-none">
                    <img src="{{ asset('front/img/close.svg') }}" alt="Close">
                </div>
                Menu
            </button>
        </li>
        <li>
            <a href="#">
                <div class="icon">
                    <img src="{{ asset('front/img/doctor.svg') }}" alt="Doctor">
                </div>
                Doctor
            </a>
        </li>
        <li>
            <a href="#">
                <div class="icon">
                    <img src="{{ asset('front/img/calendar-tick.svg') }}" alt="Appointment">
                </div>
                Book Apt.
            </a>
        </li>
        <li>
            <a href="#">
                <div class="icon">
                    <img src="{{ asset('front/img/chat.svg') }}" alt="Chat">
                </div>
                Chat
            </a>
        </li>
        <li>
            <a href="#">
                <div class="icon">
                    <img src="{{ asset('front/img/call.svg') }}" alt="Call">
                </div>
                Call Back
            </a>
        </li>

    </ul>

</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#toggle-navbar').click(function() {
                console.log('click');

                $('#navbar').toggleClass('show-navbar');
                $('#navbar').css({
                    'transform': 'scale(1)'
                })
            })
        })
    </script>
@endpush
