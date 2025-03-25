<section class="ailment">
    <div class="main-container">
        <div class="heading-group text-center">
            <div class="heading">
                Ailments
            </div>
            <div class="heading-xs">
                Team approach and compassionate care for holistic heart health
            </div>
        </div>
        <div class="content-wrapper d-flex">
            <div class="desktop-list align-self-start align-self-xl-center px-3">
                <ul>
                    @foreach ($specialityAliments as $index => $aliment)
                        <li>
                            <button
                                class="ailment-tab heading-xs {{ $index == 0 ? 'active-btn' : '' }} d-flex justify-content-between"
                                onclick="setAilmentActive(this)"
                                data-target="aliment-{{ $aliment->id }}">{{ $aliment->title }} <i
                                    class="bi bi-chevron-right"></i></button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="info-container">
                @foreach ($specialityAliments as $index => $aliment)
                    <div class="ailment-tabs {{ $index == 0 ? 'active' : '' }}"
                        data-content="aliment-{{ $aliment->id }}">
                        <button
                            class="ailment-tab heading-xs {{ $index == 0 ? 'active-btn' : '' }} px-3 d-flex justify-content-between"
                            onclick="setAilmentActive(this)" data-target="aliment-{{ $aliment->id }}">
                            {{ $aliment->title }}
                            <i class="bi bi-chevron-up"></i>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="treatment-container" data-content="aliment-{{ $aliment->id }}">
                            <div class="img-side px-3">
                                <div class="treatment-img">
                                    @if ($aliment->icon)
                                        <img src="{{ Storage::url($aliment->icon) }}" alt="{{ $aliment->title }}">
                                    @endif
                                </div>
                            </div>
                            <div class="para-wrap">
                                {{ $aliment->short_description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
