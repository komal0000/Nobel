<footer class="mt-5" id="footer">
    <div class="footer-top">
        <div class="main-container">
            <div class="footer-row d-flex justify-content-evenly">
                <div class="footer-block" onclick="expandFooter(this)">
                    <h4 class="block-title">For Patients </h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('doctor.index') }}">Find a Doctor</a></li>
                        <li><a href="{{ route('treatment.index') }}">Treatments</a></li>
                        <li><a href="tel:102">Emergency 24x7</a></li>
                        <li><a href="{{ route('technology.index') }}">Technology</a></li>
                        <li><a href="{{ route('knowledge.videos', 'type_id=3') }}">Patient Testimonials</a></li>
                        {{-- <li><a href="#">CPR</a></li> --}}
                    </ul>
                </div>
                <div class="footer-block wow fadeInUp" onclick="expandFooter(this)">
                    <h4 class="block-title">Specialities</h4>
                    @includeif('front.cache.home.footer')
                </div>
                <div class="footer-block" onclick="expandFooter(this)">
                    <h4 class="block-title">Corporate</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">About us</a></li>
                        <li><a href="{{ route('knowledge.blog.index') }}">Blogs</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        <li><a href="{{ route('event') }}">News &amp; Events</a></li>
                        <li><a href="{{ route('policy') }}">Policies &amp; Forms</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="main-container">
            @includeIf('front.cache.home.footerLink')
            @includeIf('front.cache.copy')
        </div>
    </div>
</footer>
@section('js')
      <script>
        function expandFooter(el) {
            $(el).toggleClass('active');
          }
      </script>
@endsection
