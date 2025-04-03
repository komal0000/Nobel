@props(['class' => '', 'image' => '', 'title' => '', 'slot' => '', 'btn' => 'Know More', 'href' => ''])
<div class="d-flex flex-column flex-xl-row-reverse main-card {{ $class }}">
    @if ($image)
        <div class="img-wrapper">
            <img src="{{ $image }}" alt="{{ $title ?? 'Card Image' }}" class="img-fluid">
        </div>
    @endif
    <div class="body {{ !$image ? 'full-width' : '' }}">
        <h3 class="title heading-md">{{ $title }}</h3>
        <p class="para-wrap content">{{ $slot }}</p>
        <div class="d-flex justify-content-between know-btn">
            <x-hoverBtn href="{{ $href }}">{{ $btn }}</x-hoverBtn>
        </div>
    </div>
</div>
