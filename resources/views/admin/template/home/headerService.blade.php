<ul class="drop-menu">
    @foreach ($homeServices as $service)
        <li>
            <a href="#" class="drop-item">{{ $service->title }}</a>
        </li>
    @endforeach
</ul>
