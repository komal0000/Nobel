<section id="ailment-banner">
    <div class="wrapper">
        <picture class="img-wrap">
            <source media="(min-width: 768px)" srcset="{{ Storage::url($aliment->single_page_image) }}">
            <source media="(min-width: 320px)" srcset="{{ Storage::url($aliment->single_page_image) }}">

            <img src="{{ Storage::url($aliment->single_page_image) }}" class="img-fluid"
                alt="Treatment Banner Image">
        </picture>
        <div class="banner-wrapper">
            <div class="banner-title">
               {{$aliment->title}}<br>
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
<section id="ailment-content">
    <div class="main-container">
       <div class="scroll-anchor-links">

       </div>
    </div>
 </section>
