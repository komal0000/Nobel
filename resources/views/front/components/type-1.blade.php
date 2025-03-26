@props(['heading' => 'Default Heading', 'subHeading' => '', 'item' => '' , 'data' => []])
<div class="type-1">
    <div class="heading-group mb-4">
        @if ($subHeading)
            <div class="heading mb-2"> {{ $heading }} </div>
            <div class="para-wrap">{{ $subHeading }}</div>
        @else
            <div class="heading"> {{ $heading }} </div>
        @endif
    </div>
    <div class="content-wrapper"></div>
        <div class="custom-tabs-desktop">
            <ul>
                @foreach($data as $index => $tab)
                <li>
                    <a class="custom-tab {{ $index == 0 ? 'active' : '' }}" href="#tab{{ $index + 1 }}">{{ $tab['title'] }}
                        <span class="icon"><svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.64062 1.77973L5.36063 5.49973L1.64062 9.21973" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="list">
            <div class="custom-tab-content">
                @foreach($data as $index => $tab)
                <div class="custom-tab-panel {{ $index == 0 ? 'active' : '' }}" id="tab{{ $index + 1 }}">
                    <a href="#tab{{ $index + 1 }}" class="custom-tab {{ $index == 0 ? 'active' : '' }}">
                        {{ $tab['title'] }}
                        <span class="icon"><svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.64062 1.77973L5.36063 5.49973L1.64062 9.21973" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                    <div class="content">
                        <div class="col-wrap">
                            <div class="para">
                                <ul>
                                    <li>
                                        <div class="para-wrap">
                                            <p><strong>{{ $tab['subtitle'] }}</strong></p>
                                            <br>
                                            <p class="para-wrap-para">{{ $tab['content'] }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            @if(isset($tab['image']))
                            <div class="img-wrap square-image">
                                <img src="{{ $tab['image'] }}"
                                    class="img-fluid w-100 object-fit-cover" alt="{{ $tab['title'] }}">
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            // Desktop Tab Navigation
            $('.custom-tab').on('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs and tab panels
                $('.custom-tab').removeClass('active');
                $('.custom-tab-panel').removeClass('active');

                // Add active class to clicked tab
                $(this).addClass('active');

                // Get the target tab panel ID
                var targetTabId = $(this).attr('href');

                // Activate corresponding tab panel
                $(targetTabId).addClass('active');
            });

            // Mobile Tab Navigation (if you want similar functionality for mobile)
            $('.custom-tab-panel .custom-tab').on('click', function(e) {
                e.preventDefault();

                // Remove active class from all mobile tab panels
                $('.custom-tab-panel').removeClass('active');

                // Get the parent tab panel
                var $parentPanel = $(this).closest('.custom-tab-panel');

                // Toggle active class on parent panel
                $parentPanel.toggleClass('active');
            });
        });
    </script>
@endpush
