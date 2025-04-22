<section id="single-service-top-banner">
    <div class="wrapper">
        <picture class="img-wrap">
            <source media="(min-width: 768px)" srcset="{{ Storage::url($service->single_page_image) }}">
            <source media="(min-width: 320px)" srcset="{{ Storage::url($service->single_page_image) }}">

            <img src="{{ Storage::url($service->single_page_image) }}" class="img-fluid" alt="Treatment Banner Image">
        </picture>
        <div class="banner-wrapper">
            <div class="banner-title">
                {{ $service->title }}
            </div>
        </div>
    </div>
    <div class="callback-form">
        <form action="">
            <div class="heading-md">Request a Callback</div>
            <div class="input-wrap">
                <label for="name">Name *</label>
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-wrap">
                <label for="mobileNumber">Mobile Number *</label>
                <input type="text" name="mobileNumber" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="input-wrap">
                <label for="email">Email Address</label>
                <input type="text" name="email" placeholder="Enter Your E-mail">
            </div>
            <div class="input-wrap">
                <label for="message">Message</label>
                <input type="text" name="message" placeholder="Enter Your Message">
            </div>
            <div class="btn-wrap w-100">
                <button>Submit</button>
            </div>
        </form>
    </div>
</section>
<section id="single-service-overview">
    <div class="main-container d-block d-md-flex">
        <div class="heading mb-4">
            {{ $service->title }}
        </div>
        <div class="content-wrapper">
            <p class="para-wrap collapsed">
                {{ $service->short_desc }}
            </p>
            <button class="read-more-btn">Read More <i class="bi bi-chevron-down"></i></button>
        </div>
    </div>
</section>
