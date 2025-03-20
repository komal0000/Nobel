<section class="events-news">
    <div class="main-container">
        <div class="heading text-center">
            News & Events
        </div>
        <x-hoverBtn class="common-button">View All News & Events</x-hoverBtn>
        <div class="d-flex flex-column flex-xl-row justify-content-between gap-5">
            <div class="post-card">
                <img src="{{ Storage::url($latestNews->image) }}" alt="Post Image" class="img-fluid">
                <div class="body">
                    <div class="date">Chaitra 1, 2081</div>
                    <p class="content">{{ $letestNews->text }}</p>
                    <div class="d-flex justify-content-between know-btn">
                        <x-hoverBtn>Read Post</x-hoverBtn>
                    </div>
                </div>
            </div>
            <div class="post-list">
                @foreach ($newsDatas as $data)
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
                <div class="events">
                    <div class="heading-sm">Upcoming Events</div>
                    <ul class="tabs d-flex justify-content-evenly p-0">
                        @foreach ($eventTypes as $type )
                        <li><button onclick="changeTab(this)" class="tab active-tab">{{$type->title}}</button></li>
                        @endforeach
                    </ul>
                    <div class="each-event d-flex align-items-center gap-2">
                        <div class="date d-flex flex-column justify-content-center align-items-center">
                            <div class="number">1</div>
                            <div class="month">Chaitra</div>
                        </div>
                        <div class="content d-flex flex-column gap-2">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim error at ipsa velit saepe
                                consequatur quos expedita ea, vitae corporis.</p>
                            <div class="location">
                                <i class="bi bi-geo-alt"></i> Biratnagar
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
@push('js')
    <script>
        function changeTab(el) {

            $('.tab').removeClass('active-tab');
            $(el).addClass('active-tab');
        }
    </script>
@endpush
