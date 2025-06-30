@props(['heading' => '', 'subHeading' => '', 'items' => ''])
<div class="type-1">
    <div class="heading-group mb-4">
        @if ($subHeading)
            <div class="heading mb-2"> {{ $heading }} </div>
            <div class="para-wrap">{{ $subHeading }}</div>
        @else
            <div class="heading"> {{ $heading }} </div>
        @endif
    </div>
    <div class="content-wrapper">
        <div class="custom-tabs-desktop">
            <ul>
                @if (is_array($items) || (is_object($items) && $items instanceof \Traversable))
                    @foreach ($items as $index => $item)
                        <li>
                            <a class="custom-tab {{ $index === 0 ? 'active' : '' }}"
                                href="#tab{{ $item->id ?? $index + 1 }}">
                                {{ $item->title ?? 'Item' }}
                                <span class="icon">
                                    <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.64062 1.77973L5.36063 5.49973L1.64062 9.21973" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>
                        <a class="custom-tab active" href="#tab{{ $items->id ?? 1 }}">
                            {{ $items->title ?? 'Item' }}
                            <span class="icon">
                                <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.64062 1.77973L5.36063 5.49973L1.64062 9.21973" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="list">
            <div class="custom-tab-content">
                @if (is_array($items) || (is_object($items) && $items instanceof \Traversable))
                    @foreach ($items as $index => $item)
                        <div class="custom-tab-panel {{ $index === 0 ? 'active' : '' }}"
                            id="tab{{ $item->id ?? $index + 1 }}">
                            <a href="#tab{{ $item->id ?? $index + 1 }}"
                                class="custom-tab {{ $index === 0 ? 'active' : '' }}">
                                {{ $item->title ?? 'Item' }}
                                <span class="icon">
                                    <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
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
                                                    <p><strong>{{ $item->short_description ?? '' }}</strong></p>
                                                    @if ($item->description)
                                                        <p class="para-wrap-para">{{ $item->description ?? '' }}</p>
                                                    @else
                                                        <p class="para-wrap-para">{{ $item->long_description ?? '' }}</p>
                                                    @endif
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @if ($item->icon ?? ($item->image ?? null))
                                        <div class="img-wrap square-image">
                                            <img src="{{ asset($item->icon ?? $item->image) }}"
                                                class="img-fluid w-100 object-fit-cover"
                                                alt="{{ $item->title ?? 'Item Image' }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="custom-tab-panel active" id="tab{{ $items->id ?? 1 }}">
                        <a href="#tab{{ $items->id ?? 1 }}" class="custom-tab active">
                            {{ $items->title ?? 'Item' }}
                            <span class="icon">
                                <svg width="7" height="11" viewBox="0 0 7 11" fill="none"
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
                                                <p><strong>{{ $items->short_description ?? '' }}</strong></p>
                                                <br>
                                                @if ($items->description)
                                                   <p class="para-wrap-para">{{ $items->description ?? '' }}</p>
                                                @else
                                                   <p class="para-wrap-para">{{ $items->long_description ?? '' }}</p>
                                                @endif
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @if ($items->icon ?? null)
                                    <div class="img-wrap square-image">
                                        <img src="{{ asset($items->icon) }}"
                                            class="img-fluid w-100 object-fit-cover"
                                            alt="{{ $items->title ?? 'Item Image' }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            // Use event delegation on the document
            $(document).on('click', '.custom-tab', function(e) {
                e.preventDefault();

                // Find the parent component container
                const componentContainer = $(this).closest('.type-1');

                // Remove active states within this specific component
                componentContainer.find('.custom-tab').removeClass('active');
                componentContainer.find('.custom-tab-panel').removeClass('active');

                // Add active class to clicked tab
                $(this).addClass('active');

                // Get the target tab panel ID
                var targetTabId = $(this).attr('href');

                // Activate corresponding tab panel
                $(targetTabId).addClass('active');
            });
        });
    </script>
@endpush
