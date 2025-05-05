<div class="tab-panel" id="tab-3">
    <div class="tab-slider">
        @foreach ($indexStudies as $study )
        <div class="each-card">
            <div class="img-wrapper">
                <img src="{{ asset($study->image)}}" alt="Blog">
            </div>
            <div class="body">
                <div class="type mb-2">{{$study->blog_category_title}}</div>
                <div class="heading-xs mb-2">{{$study->title}}</div>
                <x-hoverBtn href="{{ route('knowledge.casestudy.single', ['slug' => $study->slug]) }}" class="para-wrap">Continue Reading</x-hoverBtn>
            </div>
        </div>
        @endforeach
    </div>
</div>