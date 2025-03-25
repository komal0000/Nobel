<section class="treatment">
    <div class="main-container">
        <div class="heading-group text-center">
            <div class="heading">
                Treatments
            </div>
            <div class="heading-xs">
                Team approach and compassionate care for holistic heart health
            </div>
        </div>
        <div class="content-wrapper d-flex">
            <div class="desktop-list align-self-start align-self-xl-center px-3">
                <ul>
                    @foreach($specialityTreatment as $key => $item)
                    <li>
                        <button class="treatment-tab heading-xs {{ $key == 0 ? 'active-btn' : '' }} d-flex justify-content-between"
                            onclick="setTreatmentActive(this)" data-target="ailment-{{ $item->id }}">
                            {{ $item->title }}
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="info-container">
                @foreach($specialityTreatment as $key => $item)
                <div class="treatment-tabs {{ $key == 0 ? 'active' : '' }}" data-content="ailment-{{ $item->id }}">
                    <button class="treatment-tab heading-xs {{ $key == 0 ? 'active-btn' : '' }} px-3 d-flex justify-content-between"
                        onclick="setTreatmentActive(this)" data-target="ailment-{{ $item->id }}">
                        {{ $item->title }}
                        <i class="bi bi-chevron-up"></i>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="treatment-container" data-content="ailment-{{ $item->id }}">
                        <div class="img-side px-3">
                            <div class="treatment-img">
                                <img src="{{ Storage::url($item->icon) }}" alt="{{ $item->title }}">
                            </div>
                        </div>
                        <div class="para-wrap">
                            {{ $item->short_description }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
