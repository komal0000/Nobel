<a href="{{ route('index') }}">
    <picture>
        <source media="(min-width: 768px)" srcset="{{ Storage::url($curdata['logo']) }}">
        <source media="(max-width: 767px)" srcset="{{ Storage::url($curdata['mobileLogo']) }}">
        <img class="img-fluid" src="{{ Storage::url($curdata['logo']) }}" alt="Slider Image">
    </picture>
</a>
