<section id="why-hospital" class="why-hospital" data-content="Why Us?">
    <div>
        <div class="why-wrapper">
            <h2 class="text-center heading pb-40 wow fadeInDown">
                Model of Care</h2>
            <div class="why-details">
                <div class="why-list">
                    @foreach ($HomeCareData as $data)
                        <div class="images">
                            @if ($loop->index == 0)
                                <img src="{{ asset($data->image) }}" alt="Center Image" class="center-image">
                            @endif
                        </div>
                        @if ($loop->index == 0)
                            <div class="why-block-a why-block active-why blocking-hover wow fadeInDown">
                                <div class="click-text">
                                    <div class="block-head active">{{ $data->title }}</div>
                                    <div class="common-button">
                                        <x-hoverBtn href="{{$data->link}}" class="anchor-button">Know
                                            More
                                        </x-hoverBtn>
                                    </div>
                                </div>
                                <a href="{{$data->link}}" class="abc">
                                    <div datasrc="{{ asset($data->image) }}" class="click-circle active"></div>
                                </a>
                            </div>
                        @elseif ($loop->index == 1)
                            <div class="why-block-b why-block blocking-hover wow fadeInRight">
                                <a href="{{$data->link}}" class="abc">
                                    <div datasrc="{{ asset($data->image) }}" class="click-circle active"></div>
                                </a>
                                <div class="click-text">
                                    <div class="block-head active">{{ $data->title }}</div>
                                    <div class="common-button">
                                        <x-hoverBtn href="{{$data->link}}" class="anchor-button">Know
                                            More
                                        </x-hoverBtn>
                                    </div>
                                </div>
                            </div>
                        @elseif ($loop->index == 2)
                            <div class="why-block-c why-block blocking-hover wow fadeInRight">
                                <a href="{{$data->link}}" class="abc">
                                    <div datasrc="{{ asset($data->image) }}" class="click-circle active"></div>
                                </a>
                                <div class="click-text">
                                    <div class="block-head active">{{ $data->title }}</div>
                                    <div class="common-button">
                                        <x-hoverBtn href="{{$data->link}}" class="anchor-button">Know
                                            More
                                        </x-hoverBtn>
                                    </div>
                                </div>
                            </div>
                        @elseif ($loop->index == 3)
                            <div class="why-block-d why-block blocking-hover wow fadeInLeft">
                                <div class="click-text">
                                    <div class="block-head active">{{ $data->title }}</div>
                                    <div class="common-button">
                                        <x-hoverBtn href="{{$data->link}}" class="anchor-button">Know
                                            More
                                        </x-hoverBtn>
                                    </div>
                                </div>
                                <a href="{{$data->link}}" class="abc">
                                    <div datasrc="{{ asset($data->image) }}" class="click-circle active"></div>
                                </a>
                            </div>
                        @elseif ($loop->index == 4)
                            <div class="why-block-e why-block blocking-hover wow fadeInLeft">
                                <div class="click-text">
                                    <div class="block-head active">{{ $data->title }}</div>
                                    <div class="common-button">
                                        <x-hoverBtn href="{{ route($data->link) }}" class="anchor-button">Know
                                            More
                                        </x-hoverBtn>
                                    </div>
                                </div>
                                <a href="{{$data->link}}" class="abc">
                                    <div datasrc="{{ asset($data->image) }}" class="click-circle active"></div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="why-resp-wrapper">
        <div class="text-center heading">Model of Care</div>
        <div class="why-resp-content">
            <div class="accor-list wow fadeInUp">
                <ul class="list-accor">
                    @foreach ($HomeCareData as $data)
                        <li onclick="expandResLi(this)">
                            <h3 class="heading-sm accor-heading">{{ $data->title }}</h3>
                            <div class="accor-collapse-wrapper">
                                <img loading="lazy" src="{{ asset($data->image) }}" alt="Why Nobel" width="460" height="460"
                                    class="ratio ratio-1x1">
                                <div class="common-button">
                                    <x-hoverBtn href="{{$data->link}}" class="anchor-button">Know More
                                    </x-hoverBtn>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>