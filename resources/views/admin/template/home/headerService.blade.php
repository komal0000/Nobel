<ul class="drop-menu">
    @foreach ($homeServices as $service)
        <li>
            <a href="{{ route('service.single', ['service_id' => $service->id]) }}"
                class="drop-item">{{ $service->title }}</a>
        </li>
    @endforeach
</ul>
