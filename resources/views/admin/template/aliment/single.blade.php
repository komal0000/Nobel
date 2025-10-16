<section id="ailment-banner">
    <div class="wrapper">
        <picture class="img-wrap">
            <source media="(min-width: 768px)" srcset="{{ asset($aliment->single_page_image) }}">
            <source media="(min-width: 320px)" srcset="{{ asset($aliment->single_page_image) }}">

            <img src="{{ asset($aliment->single_page_image) }}" class="img-fluid" alt="Treatment Banner Image">
        </picture>
        <div class="banner-wrapper">
            <div class="banner-title">
                {{ $aliment->title }}<br>
            </div>
        </div>
    </div>
    <div class="callback-form">
        <form action="{{ route('setting.addRequestCallBack') }}" method="post" id="callback-form">
            <div class="heading-md">Request a Callback</div>
            <div class="input-wrap">
                <label for="name">Name *</label>
                <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-wrap">
                <label for="mobileNumber">Mobile Number *</label>
                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="input-wrap">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter Your E-mail">
            </div>
            <div class="input-wrap">
               <label for="message">Message *</label>
               <input type="text" name="message" id="message" placeholder="Enter Your Message" required>
           </div>
            <div class="btn-wrap w-100">
                <button id="submit-callback" type="submit">Submit</button>
            </div>
        </form>
    </div>
</section>
<section id="ailment-overview" data-content="Overview">
    <div class="main-container d-block d-md-flex">
        <div class="heading mb-4">
            {{ $aliment->title }}
        </div>
        <div class="content-wrapper">
            <p class="para-wrap collapsed">
                {{ $aliment->short_description }}
            </p>
            <button class="read-more-btn">Read More <i class="bi bi-chevron-down"></i></button>
        </div>
    </div>
</section>

@foreach ($alimentTypes as $type)
    @php
        $alimentSection = App\Models\AlimentSection::where('aliment_id', $aliment->id)
            ->where('aliment_section_type_id', $type->id)
            ->first();
    @endphp
    @if ($alimentSection)
      <section id="{{ str_replace(' ', '_', $type->title) }}" class="ailment-type-section" data-content="{{ $type->title }}">
          <div class="main-container">
         <h2 class="ailment-type heading">
             {{ $alimentSection->title }}
         </h2>
         <div class="ailment-description">
             {!! $alimentSection->description !!}
         </div>
          </div>
      </section>
    @endif
@endforeach
