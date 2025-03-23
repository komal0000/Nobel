<section class="contact">
    <div class="main-container">
        <div class="heading-group mb-5">
            <div class="heading text-center mb-3">Contact Us</div>
            <div class="text-center para-wrap">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem sapiente earum amet ducimus. Magnam, nihil quam tempore tempora aperiam molestiae!</p>
            </div>
        </div>
        <div class="form-container p-4">
            <div class="row g-4 justify-content-evenly">
                <div class="detail col-lg-4 p-0 pb-4">
                    <div class="heading-md p-4">Contact Details</div>
                    <div class="first d-flex gap-3 border-bottom w-100 px-4 pb-2">
                        <div class="logo align-self-center">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="info">
                            <div class="head">Phone Number</div>
                            <a href="tel:+9779876543210" class="number">+977-9876543210</a>
                        </div>
                    </div>
                    <div class="first d-flex gap-3 px-4 pt-2">
                        <div class="logo align-self-center">
                            <i class="bi bi-share-fill"></i>
                        </div>
                        <div class="info border-bottom-1">
                            <div class="head">Follow Us</div>
                            <div class="socials d-flex gap-3">
                                <a href="https://www.facebook.com" target="_blank"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
                                <a href="https://www.youtube.com" target="_blank"><i class="bi bi-youtube"></i></a>
                                <a href="https://www.x.com" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form col-lg-7">
                    @csrf
                    <div class="heading-md mb-4">Feedback</div>
                    <div class="row">
                        <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="fullName" class="form-control" placeholder="Full Name *" required>
                            <label for="fullName">Full Name *</label>
                        </div>
                        <div class="form-floating mb-3 col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email Address *" required>
                            <label for="email">Email Address *</label>
                        </div>
                        <div class="form-floating mb-3 col-md-6">
                            <input type="text" name="mobileNumber" class="form-control" placeholder="Mobile Number *" required>
                            <label for="mobileNumber">Mobile Number *</label>
                        </div>
                        <div class="form-floating mb-3 col-12">
                            <textarea name="Feedback" class="form-control" placeholder="Enter your feedback here" required></textarea>
                            <label for="feedback">Enter your feedback here *</label>
                        </div>
                    </div>
                    <div class="button align-self-center">
                        <button class="submit-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
