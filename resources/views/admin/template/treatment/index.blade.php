<x-allPage title="All Treatments">
    @foreach ($treatments as $treatment)
        <div class="col-md-6 each-card">
            <x-card class="bg-white"  title="{{ $treatment->title }}"  image="{{ Storage::url($treatment->icon) }}"
                href="{{ route('treatment.single', $treatment->slug) }}">
                {{ $treatment->short_description }}
            </x-card>
        </div>
    @endforeach
</x-allPage>
