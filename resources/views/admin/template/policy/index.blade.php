<section id="policy-container">
    <div class="main-container">
        <div class="content">
            <div class="content-wrapper d-flex gap-3">
                <div class="desktop-list align-self-start px-3">
                    <ul>
                        @foreach($policies as $index => $policy)
                        <li>
                            <button class="type-2-tab heading-xs {{ $index === 0 ? 'active-btn' : '' }} d-flex justify-content-between"
                                data-target="policy-{{ $policy->id }}">{{ $policy->title }} <i
                                    class="bi bi-chevron-right"></i></button>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="info-container">
                    @foreach($policies as $index => $policy)
                    <div class="type-2-tabs {{ $index === 0 ? 'active' : '' }}" data-content="policy-{{ $policy->id }}">
                        <button class="type-2-tab heading-xs {{ $index === 0 ? 'active-btn' : '' }} px-3 d-flex justify-content-between"
                            data-target="policy-{{ $policy->id }}">
                            {{ $policy->title }}
                            <i class="bi bi-chevron-up"></i>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <div class="treatment-container" data-content="policy-{{ $policy->id }}">
                            <div class="para-wrap">
                                {!! $policy->description !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
