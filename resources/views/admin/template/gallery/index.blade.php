<section id="galleries">
   <div class="main-container">
      <div class="row g-3">
         @foreach ($galleryTypes as $type)
         <div class="col-md-6 col-lg-4 col-xl-3">
            <a href="{{route('gallery.single', ['slug' => $type->slug])}}" class="gallery-card">
               <div class="img-wrapper">
                  <img src="{{ asset($type->image) }}" alt="Gallery Type Image">
               </div>
               <div class="body">
                  <div class="heading-sm">
                     {{$type->title}}
                  </div>
               </div>
            </a>
         </div>
         @endforeach
      </div>
   </div>
</section>