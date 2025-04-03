<x-allPage title="All Ailments">
    @foreach ($aliments as $aliment)
        <div class="col-md-6 each-card">
            <x-card class="bg-white rounded-4" title="{{ $aliment->title }}" slot="" href="{{ route('aliment.single', $aliment->id) }}">
                {{ $aliment->short_description }}
            </x-card>
        </div>
    @endforeach
</x-allPage>
