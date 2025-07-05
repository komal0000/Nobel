<section id="single-service-top-banner">
    <div class="wrapper">
        <picture class="img-wrap">
            <source media="(min-width: 768px)" srcset="{{ asset($service->single_page_image) }}">
            <source media="(min-width: 320px)" srcset="{{ asset($service->single_page_image) }}">

            <img src="{{ asset($service->single_page_image) }}" class="img-fluid" alt="Treatment Banner Image">
        </picture>
        <div class="banner-wrapper">
            <div class="banner-title">
                {{ $service->title }}
            </div>
        </div>
    </div>
    <div class="callback-form">
        <form id="callback-form" action="{{ route('setting.addRequestCallBack') }}" method="post">
            <div class="heading-md">Request a Callback</div>
            <div class="input-wrap">
                <label for="name">Name *</label>
                <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-wrap">
                <label for="phoneNumber">Mobile Number *</label>
                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="input-wrap">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter Your E-mail">
            </div>
            <div class="input-wrap">
               <label for="message">Message *</label>
               <input type="text" name="message" id="message" placeholder="Enter Your Message*" required>
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
