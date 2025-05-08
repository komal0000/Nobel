<section id="single-service-elder">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Our Packages
        </div>
        <div class="package-list">
            <div class="package-slider">
                @foreach ($packages2 as $package)
                    <div class="each-package">
                        <div class="heading-sm">{{$package->title}}</div>
                        <div class="package-body">
                            <ul>
                                {!! $package->description !!}
                            </ul>
                        </div>
                        <div class="package-price">
                            <div class="price">Rs. {{$package->price}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
