<section id="single-service-elder">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Our Packages
        </div>
        @php
            $count = count($packages2);
            $width = '100%';
            if ($count == 2) {
                $width = '50%';
            } elseif ($count == 3) {
                $width = '33.3333%';
            } elseif ($count == 4) {
                $width = '25%';
            }
        @endphp
        <div class="package-list">
            <div class="package-slider overflow-hidden">
                @foreach ($packages2 as $package)
                    <div class="each-package" style="width: {{ $width }}">
                        <div class="heading-sm">{{ $package->title }}</div>
                        <div class="package-body">
                            <ul>
                                {!! $package->description !!}
                            </ul>
                        </div>
                        <div class="package-price">
                            <div class="price">Rs. {{ $package->price }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
