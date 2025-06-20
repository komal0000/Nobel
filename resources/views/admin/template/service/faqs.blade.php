@php
$data =
    App\Helper::getSetting('contact') ??
    (object) [
        'email' => '',
    ];
    $phones =
        is_array($data->phone) || is_object($data->phone)
            ? (object) $data->phone
            : (object) [
                'phone1' => '',
                'phone2' => '',
                'phone3' => '',
                'phone4' => '',
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
         @foreach ($phones as $phone)
         <div class="connect-card p-3 d-flex flex-column justify-content-center align-items-center">
            <i class="bi bi-telephone"></i>
            <div class="text-center" href="tel:{{$phone}}">{{$phone}}</div>
         </div>
         @endforeach
          <div class="connect-card p-3 d-flex flex-column justify-content-center align-items-center">
             <i class="bi bi-envelope"></i>
             <a class="text-center" href="mailto:{{$data->email}}">{{$data->email}}</a>
          </div>
       </x-sliderComponent>
    </div>
 </section>
