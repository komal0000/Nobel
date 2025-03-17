@props(['href' => '#', 'target' => '_self', 'class' => ''])

<a href="{{ url($href) }}" class="hover-btn-link d-inline-flex align-items-center {{$class}}" target="{{ $target }}">
    <div class="hover-btn">
        {{ $slot }}
    </div>
    <div class="orange-right d-flex justify-content-center align-items-center">
        <span class="anchor-right-btn"></span>
    </div>
</a>
