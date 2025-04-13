<footer class="mt-5" id="footer">
    <div class="footer-top">
        <div class="main-container">
            <div class="footer-row d-flex justify-content-evenly">
                <div class="footer-block" onclick="expand(this)">
                    <h4 class="block-title" >For Patients </h4>
                    <ul class="footer-links" >
                        <li><a href="#">Find a Doctor</a></li>
                        <li><a href="#">Book Appointment</a></li>
                        <li><a href="#">Treatments</a></li>
                        <li><a href="#">Emergency 24x7</a></li>
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Patient Testimonials</a></li>
                        <li><a href="#">CPR</a></li>
                    </ul>
                </div>
                <div class="footer-block wow fadeInUp" onclick="expand(this)">
                    <h4 class="block-title"  >Specialities</h4>
                    @includeif('front.cache.home.footer')
                </div>
                <div class="footer-block" onclick="expand(this)">
                    <h4 class="block-title" >Corporate</h4>
                    <ul class="footer-links">
                        <li><a href="#">Help Desk</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Blogs</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Feedback</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">News &amp; Events</a></li>
                        <li><a href="#">Investor Relations</a></li>
                        <li><a href="{{ route('policy') }}">Policies &amp; Forms</a></li>
                        <li><a href="#">Coronary Stent Prices</a></li>
                        <li><a href="#">Orthopaedic Knee Implant Prices</a></li>
                        <li><a href="#">Biomedical Waste Report</a></li>
                        <li><a href="#">Sitemap</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="main-container">
            @includeIf('front.cache.home.footerLink')
            @includeIf('front.includes.copy')
        </div>
    </div>
</footer>
