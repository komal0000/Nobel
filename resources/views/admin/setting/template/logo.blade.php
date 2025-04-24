<a href="{{ route('index') }}" class="logo-link">
    <picture>
        <source media="(min-width: 768px)" srcset="{{ asset($curdata['logo']) }}">
        <source media="(max-width: 767px)" srcset="{{ asset($curdata['mobileLogo']) }}">
        <img class="logo" src="{{ asset($curdata['logo']) }}" alt="Slider Image">
    </picture>
</a>
