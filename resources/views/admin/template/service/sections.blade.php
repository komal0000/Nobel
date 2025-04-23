@if ($section->image_placement == 'left')
    <section id="single-service-qn">
        <div class="main-container">
            <div class="heading text-center text-capitalize mb-4">
                Understand When To Take This Service
            </div>
            <div class="qn-body">
                <div class="qn-list">
                    <div class="qn-picture"> {{-- image aspect ratio: 4:2 --}}
                        <img src="{{ asset('front/img/second-opinion.jpg') }}" height="400" width="800"
                            alt="Second Opinion Image">
                    </div>
                    <div class="heading-sm list-heading">
                        Heading of the list
                    </div>
                    <ul>
                        <li>Diagnosed with a critical ailment</li>
                        <li>Doctors have suggested an invasive surgery</li>
                        <li>If the recommended treatment is risky, invasive or has lifelong consequences</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
@elseif($section->image_placement == 'right')
    <section id="single-service-qn">
        <div class="main-container">
            <div class="heading text-center text-capitalize mb-4">
              {{ $section->title }}
            </div>
            <div class="qn-body">
                <div class="qn-list">
                   {!! $section->short_desc1 !!}
                </div>
                <div class="qn-picture"> {{-- image aspect ratio: 4:2 --}}
                    <img src="{{ asset('front/img/second-opinion.jpg') }}" height="400" width="800"
                        alt="Second Opinion Image">
                </div>
            </div>
        </div>
    </section>
@endif
