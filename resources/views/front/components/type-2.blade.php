@props(['heading' => 'Default Heading', 'subHeading' => 'Default sub-heading', 'items' => ''])
<div class="type-2">
    <div class="heading-group mb-4">
        @if ($subHeading)
            <div class="heading mb-2"> {{ $heading }} </div>
            <div class="para-wrap">{{ $subHeading }}</div>
        @else
            <div class="heading"> {{ $heading }} </div>
        @endif
    </div>
    <div class="content-wrapper d-flex">
        <div class="desktop-list align-self-start align-self-xl-center px-3">
            <ul>
                @if(is_array($items) || is_object($items) && $items instanceof \Traversable)
                    @foreach($items as $index => $item)
                    <li>
                        <button class="type-2-tab heading-xs {{ $index === 0 ? 'active-btn' : '' }} d-flex justify-content-between"
                            data-target="item-{{ $item->id }}">{{ $item->title ?? 'Item' }} <i class="bi bi-chevron-right"></i></button>
                    </li>
                    @endforeach
                @else
                    <li>
                        <button class="type-2-tab heading-xs active-btn d-flex justify-content-between"
                            data-target="item-{{ $items->id }}">{{ $items->title ?? 'Item' }} <i class="bi bi-chevron-right"></i></button>
                    </li>
                @endif
            </ul>
        </div>

        <div class="info-container">
            @if(is_array($items) || is_object($items) && $items instanceof \Traversable)
                @foreach($items as $index => $item)
                <div class="type-2-tabs {{ $index === 0 ? 'active' : '' }}" data-content="item-{{ $item->id }}">
                    <button class="type-2-tab heading-xs {{ $index === 0 ? 'active-btn' : '' }} px-3 d-flex justify-content-between"
                        data-target="item-{{ $item->id }}">
                        {{ $item->title ?? 'Item' }}
                        <i class="bi bi-chevron-up"></i>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="treatment-container" data-content="item-{{ $item->id }}">
                        @if($item->icon ?? $item->image ?? null)
                        <div class="img-side px-3">
                            <div class="treatment-img">
                                <img src="{{ Storage::url($item->icon ?? $item->image) }}" alt="{{ $item->title}}">
                            </div>
                        </div>
                        @endif
                        <div class="para-wrap">
                            {{ $item->description ??  $item->short_description ?? '' }}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="type-2-tabs active" data-content="item-{{ $items->id }}">
                    <button class="type-2-tab heading-xs active-btn px-3 d-flex justify-content-between"
                        data-target="item-{{ $items->id }}">
                        {{ $items->title ?? 'Item' }}
                        <i class="bi bi-chevron-up"></i>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="treatment-container" data-content="item-{{ $items->id }}">
                        @if($items->image ?? null)
                        <div class="img-side px-3">
                            <div class="treatment-img">
                                <img src="{{ asset($items->image) }}" alt="{{ $items->title ?? 'Item Image' }}">
                            </div>
                        </div>
                        @endif
                        <div class="para-wrap">
                            {{ $items->description ?? $items->short_description ?? '' }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            // Use event delegation on the document
            $(document).on('click', '.type-2-tab', function(event) {
                // Find the parent component container
                const componentContainer = $(this).closest('.type-2');

                // Remove active states within this specific component
                componentContainer.find('.type-2-tab').removeClass('active-btn');
                componentContainer.find('.type-2-tabs').removeClass('active');

                // Add active state to clicked button
                $(this).addClass('active-btn');

                // Get the target content ID
                const targetId = $(this).data('target');

                // Activate the corresponding content
                const targetContent = componentContainer.find(`.type-2-tabs[data-content="${targetId}"]`);

                if (targetContent.length) {
                    targetContent.addClass('active');
                    targetContent.find('.type-2-tab').addClass('active-btn');
                }
            });
        });
    </script>
@endpush
