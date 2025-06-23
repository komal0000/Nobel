<section class="national" id="national">
   <div class="main-container">
       <picture>
           <source media="(max-width: 991px)" srcset="{{ asset($data['mobileImage']) }}" alt="patients">
           <source media="(min-width: 992px)" srcset="{{ asset($data['desktopImage']) }}" alt="patients">
           <img src="{{ asset($data['desktopImage']) }}" alt="Patients" class="img-fluid w-100 rounded-4">
       </picture>
   </div>
</section>