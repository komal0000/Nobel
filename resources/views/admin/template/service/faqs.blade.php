@php
$data =
    App\Helper::getSetting('contact') ??
    (object) [
        'email' => '',
        'phone' => '',
    ];
@endphp
<section id="single-service-faq">
    <div class="main-container">
        <div class="heading text-center mb-2">FAQ's</div>
        <div class="faq-container">
            @foreach ($faqs as $faq)
                <div class="question-answer para-wrap">
                    <div class="question">
                        <p>{{ $faq->question }}</p> <i class="bi bi-chevron-right"></i>
                    </div>
                    <div class="answer">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<section id="single-service-connect">
    <div class="main-container" >
       <x-sliderComponent  mainClass="serviceSingle" heading="Connect With Us">
          <div class="connect-card">
             <i class="bi bi-telephone"></i>
             <a href="tel:{{$data->phone}}">{{$data->phone}}</a>
          </div>
          <div class="connect-card">
             <i class="bi bi-envelope"></i>
             <a href="mailto:{{$data->email}}">{{$data->email}}</a>
          </div>
       </x-sliderComponent>
    </div>
 </section>
