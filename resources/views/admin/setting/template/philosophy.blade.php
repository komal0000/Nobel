<div class="philosophy">
    <div class="img-wrapper">
        <img src="{{ asset($curdata['image']) }}" alt="Philosophy Image">
    </div>
    <div class="content">
        <div class="heading mb-4">
            {{ $curdata['title'] }}
        </div>
        <div class="para-wrap">
            <p>{{ $curdata['description'] }}</p>
        </div>
    </div>
</div>
