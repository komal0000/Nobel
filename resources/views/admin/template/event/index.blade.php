<section id="event-top-banner">
    <picture class="img-wrap">
        <source media="(min-width: 768px)" srcset="{{ asset('front/assets/img/events/bg.jpg') }}" width="1920"
            height="500" alt="News Events">
        <source media="(min-width: 320px)" srcset="{{ asset('front/assets/img/events/bg-md.jpg') }}" width="480"
            height="320" alt="News Events">
        <img class="img-fluid w-100" src="{{ asset('front/assets/img/events/bg.jpg') }}" width="1920" height="500"
            alt="News Events">
    </picture>
    <div class="banner-title">News And Events</div>
</section>
@foreach ($newsTypes as $newsType)
    <section id="event-page" data-content="News">
        <div class="main-container">
            <div class="heading-group mb-4">
                <div class="heading text-center">{{$newsType->title}}</div>
                <x-hoverBtn class="button" href="{{ route('news.list', $newsType->slug) }}">View All {{$newsType->title}}</x-hoverBtn>
            </div>
            <div class="event-slider">
               @php
                  $allNews = \App\Models\Blog::where('blog_category_id', $newsType->id)->get();
               @endphp
                @foreach ($allNews as $news)
                    <div class="slide m-3">
                        <div class="img-wrapper">
                            <img src="{{ asset($news->image) }}" alt="News Image" class="img-fluid">
                            <div class="heading-xs date">{{ \App\Helper::formatTimestampToDateString($news->date) }}
                            </div>
                        </div>
                        <div class="body">
                            <h3 class="title heading-sm mb-2">{{ $news->title }}</h3>
                            <div class="para-wrap location mb-2"><i class="bi bi-geo-alt-fill"></i>
                                {{ $news->location }}
                            </div>
                            <div class="d-flex justify-content-between know-btn">
                                <x-hoverBtn href="{{ route('news.single', ['slug' => $news->slug]) }}">View
                                    Details</x-hoverBtn>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mobile-btn">
                <x-hoverBtn href="{{ route('news.list', $newsType->slug) }}">View All {{ $newsType->title }}</x-hoverBtn>
            </div>
        </div>
    </section>
@endforeach
@foreach ($eventTypes as $type)
    <section id="event-page" data-content="{{ $type->title }}">
        <div class="main-container">
            <div class="heading-group mb-4">
                <div class="heading text-center">{{ $type->title }}</div>
                <x-hoverBtn class="button" href="{{ route('event.list', $type->slug) }}">View All {{ $type->title }}</x-hoverBtn>
            </div>
            <div class="event-slider">
                @php
                    $events = \App\Models\Blog::where('blog_category_id', $type->id)
                        ->where('type', App\Helper::blog_type_event)
                        ->get();
                @endphp
                @foreach ($events as $event)
                    <div class="slide m-3">
                        <div class="img-wrapper">
                            <img src="{{ asset($event->image) }}" alt="Service Image" class="img-fluid">
                            <div class="heading-xs date">{{ \App\Helper::formatTimestampToDateString($event->date) }}
                            </div>
                        </div>
                        <div class="body">
                            <h3 class="title heading-sm mb-2">{{ $event->title }}</h3>
                            <div class="para-wrap location mb-2"><i class="bi bi-geo-alt-fill"></i>
                                {{ $event->location }}</div>
                            <div class="d-flex justify-content-between know-btn">
                                <x-hoverBtn href="{{ route('event.single', ['slug' => $event->slug]) }}">View
                                    Details</x-hoverBtn>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mobile-btn">
                <x-hoverBtn href="{{ route('event.list', $type->slug) }}">View All {{ $type->title }}</x-hoverBtn>
            </div>
        </div>
    </section>
@endforeach
