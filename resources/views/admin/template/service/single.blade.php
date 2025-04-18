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
<section id="single-service-faq">
    <div class="main-container">
        <div class="heading text-center mb-2">FAQ's</div>
        <div class="faq-container">
            @foreach ($faqs as $faq)
                <div class="question-answer para-wrap">
                    <div class="question">
                        <p>{{ $faq->question }}</p> <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="answer">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section id="single-service-connect">
    <div class="main-container" >
       <x-sliderComponent  mainClass="serviceSingle" heading="Connect With Us">
          <div class="connect-card">
             <i class="bi bi-telephone"></i>
             <a href="tel:1234567890">1234567890</a>
          </div>
          <div class="connect-card">
             <i class="bi bi-envelope"></i>
             <a href="mailto:nobel@mail.com">nobel@gmail.com</a>
          </div>
       </x-sliderComponent>
    </div>
 </section>
