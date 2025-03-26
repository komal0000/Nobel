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
{{-- <section id="ailment-overview">
    <div class="main-container d-block d-md-flex">
        <div class="heading mb-4">
            What Is an {{$aliment->title}}?
        </div>
        <div class="content-wrapper">
            <p class="para-wrap collapsed">
                The Achilles tendon is the largest and strongest tendon in the human body. It can be found at the
                posterior of your ankle and links your heel bone to your calf muscles. By enabling you to move your foot
                and flex your toes downwards, it plays a crucial role in movement.

                The Achilles tendon is susceptible to injury when it is pulled, overstretched, or ruptured due to rapid
                jerky motions such as jumping or pivoting, or repetitive stress such as running extended distances.

                If you have a suspicion of Achilles tendon injury, it is crucial to quickly look for medical aid. The
                physician may advise utilising the RICE method, which involves rest, ice, compression, and elevation to
                alleviate inflammation and pain. Occasionally, surgical intervention or physical therapy might be
                required.

                It is crucial to take preventive measures against Achilles tendon injuries, such as adequately warming
                up and stretching before any physical activity, donning suitable footwear, and gradually intensifying
                your exercise routine.
            </p>
            <button class="read-more-btn">Read More <i class="bi bi-chevron-down"></i></button>
        </div>
    </div>
</section> --}}
<section id="ailment-content">
    <div class="main-container">
       <div class="scroll-anchor-links">

       </div>
    </div>
 </section>
w
