<x-allPage title="All Technologies">
    @foreach ($technologiesIndex as $technology)
        <div class="col-md-6 each-card">
            <x-card class="bg-white rounded-4" title="{{ $technology->title }}" image="{{  Storage::url( $technology->image) }}"
                href="{{ route('technology.single', ['slug' => $technology->slug]) }}">{{ $technology->short_description }}</x-card>
        </div>
    @endforeach
</x-allPage>
