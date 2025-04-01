<a href="{{ route('index') }}" class="logo-link">
    <picture>
        <source media="(min-width: 768px)" srcset="{{ Storage::url($curdata['logo']) }}">
        <source media="(max-width: 767px)" srcset="{{ Storage::url($curdata['mobileLogo']) }}">
        <img class="logo" src="{{ Storage::url($curdata['logo']) }}" alt="Slider Image">
    </picture>
</a>
