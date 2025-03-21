<section class="events-news">
    <div class="main-container">
        <div class="heading text-center">
            News &amp; Events
        </div>
        <x-hoverBtn class="common-button">View All News &amp; Events</x-hoverBtn>
        <div class="d-flex flex-column flex-xl-row justify-content-between gap-5">
            @if ($latestNews)
                <div class="post-card">
                    <img src="{{ Storage::url($latestNews->image) }}" alt="Post Image" class="img-fluid">
                    <div class="body">
                        <div class="date">Chaitra 1, 2081</div>
                        <p class="content">{{ $latestNews->text }}</p>
                        <div class="d-flex justify-content-between know-btn">
                            <x-hoverBtn>Read Post</x-hoverBtn>
                        </div>
                    </div>
                </div>
            @endif

            <div class="post-list">
                @foreach ($newsData as $data)
                    <div class="list-card">
                        <div class="list">
                            <img class="img-fluid" src="{{ Storage::url($data->image) }}" alt="Post Image">
                            <div class="body d-flex flex-column gap-2">
                                <div class="date">Chaitra 1, 2081</div>
                                <div class="content">
                                    {{ $data->text }}
                                </div>
                                <div class="button">
                                    <x-hoverBtn>Read Post</x-hoverBtn>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="events">
                <div class="heading-sm">Upcoming Events</div>
                <ul class="tabs d-flex justify-content-evenly p-0">
                    @foreach ($eventTypes as $type)
                        <li>
                            <button onclick="changeTab(this)" class="tab {{ $loop->first ? 'active-tab' : '' }}"
                                data-target="tab-{{ $loop->index + 1 }}">{{ $type->title }}</button>
                        </li>
                    @endforeach
                </ul>

                @foreach ($eventTypes as $type)
                    <div class="event-list {{ $loop->first ? 'active' : '' }}" id="tab-{{ $loop->index + 1 }}">
                        @php
                            $events = $eventData->where('blog_category_id', $type->id);
                        @endphp
                        @foreach ($events as $event)
                            <div class="each-event {{ $event->type }} d-flex align-items-center gap-4">
                                <div class="date d-flex flex-column justify-content-center align-items-center">
                                    <div class="number">21</div>
                                    <div class="month">February</div>
                                </div>
                                <div class="content d-flex flex-column gap-2">
                                    <p>{{ $event->datas }}</p>
                                    <div class="location">
                                        <i class="bi bi-geo-alt"></i> location
                                    </div>
                                    <div class="button">
                                        <x-hoverBtn>View Details</x-hoverBtn>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
