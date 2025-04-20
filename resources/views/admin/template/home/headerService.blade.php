<ul class="drop-menu">
    @foreach ($homeServices as $service)
        <li>
            <a href="{{ route('service.single', ['slug' => $service->slug]) }}"
                class="drop-item">{{ $service->title }}</a>
        </li>
    @endforeach
</ul>
