<section id="single-package-top-banner">
        <div class="package-top-banner">
            <div class="img-wrapper">
                <img src="{{ asset($package->image) }}" alt="Package Image">
            </div>
            <div class="about-package">
                <div class="heading-lg mb-4">{{$package->title}}</div>
                <ul>
                  @if($package->labtest)
                  <li>Lab Tests: {{$package->labtest}}</li>
                  @endif
                  @if($package->age)
                    <li>Age Group: {{$package->age}}</li>
                  @endif
                </ul>
                @if($package->price)
                  <div class="heading-md price">Rs. {{$package->price}}</div>
                @endif
            </div>
        </div>
    </section>
    <section id="single-package-overview">
        <div class="main-container">
            <div class="heading mb-4">
                Package Description
            </div>
            <div class="content-wrapper">
               <div class="para-wrap">
                  {!! $package->description !!}
               </div>
                <button class="read-more-btn">Read More <i class="bi bi-chevron-down"></i></button>
            </div>
        </div>
    </section>