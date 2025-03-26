<section id="technology-banner">
    <div class="wrapper">
        <picture class="img-wrap">
            <source media="(min-width: 768px)" srcset="{{ asset('front/img/per-technology/banner.jpg') }}">
            <source media="(min-width: 320px)" srcset="{{ asset('front/img/per-technology/banner-md.jpg') }}">

            <img src="{{ asset('front/img/per-technology/banner.jpg') }}" class="img-fluid"
                alt="Treatment Banner Image">
        </picture>
        <div class="banner-wrapper">
            <div class="banner-title">
                Name of the treatment (Name Operation)
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
<section id="how">
    <div class="main-container">
       <x-type1></x-type1>
    </div>
</section>
<section id="benefit-risk">
    <div class="main-container">
       <x-type2 heading="What Are The Benefits & Risks Of This Technology?"
       subHeading="CT Scan has several advantages over the traditional methods of radiography. CT Scan on Wheels completely eliminates the superimposition of images, although the process comes with its own set of risks which the patient should be aware of."></x-type2>
    </div>
 </section>
 {{-- <section id="treated">
    <div class="main-container">
       <x-sliderComponent heading="Get Treated In Our Specialised Get Treated In Our Specialised Institutes & Departments">
          <div class="each-card">
             <a href="#">
                <div class="img-wrapper d-flex justify-content-center">
                   <img src="{{ asset('front/img/heart.svg') }}" alt="Treatment Image">
                </div>
                <div class="body">
                   This is for testing
                </div>
             </a>
          </div>
          <div class="each-card">
             <a href="#">
                <div class="img-wrapper d-flex justify-content-center">
                   <img src="{{ asset('front/img/heart.svg') }}" alt="Treatment Image">
                </div>
                <div class="body">
                   This is for testing
                </div>
             </a>
          </div>
          <div class="each-card">
             <a href="#">
                <div class="img-wrapper d-flex justify-content-center">
                   <img src="{{ asset('front/img/heart.svg') }}" alt="Treatment Image">
                </div>
                <div class="body">
                   This is for testing
                </div>
             </a>
          </div>
       </x-sliderComponent>
    </div>
 </section> --}}
