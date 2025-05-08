<section id="single-service-package">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Package List
        </div>
        <div class="filters">
            <div class="filter package-category-filter">
                <div class="default-select default-select-category">
                    <span class="name category-name">
                        Choose Category
                    </span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="list category-list">
                    <ul>
                        <li data-category-target="all">All</li>
                        @foreach ($packageCategories as $category)
                            <li data-category-target="{{ $category->title }}">{{ ucfirst($category->title) }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="packageCategory" id="package-category">
                </div>
            </div>
            <button class="go-btn">Go</button>
        </div>
        <div class="package-list">
            <div class="row g-4">
                @foreach ($packages1 as $package)
                    @php
                        $category = \App\Models\PackageCategory::where('id', $package->category)->first();
                    @endphp
                    <div class="col-md-6 col-lg-4 col-xl-3 package-card-col" data-category="{{ $category->title }}"
                        data-category="category-1">
                        <div class="package-card">
                            <div class="img-wrapper">
                                <img src="{{ asset($package->image) }}" alt="Service Image">
                            </div>
                            <div class="body">
                                <div class="package-title">
                                    {{ $package->title }}
                                </div>
                                <span class="price">Rs. {{ $package->price }}</span>
                                <x-hoverBtn href="{{ route('service.packageSingle', ['serviceSlug'=> $service_slug, 'slug'=> $package->slug]) }}" class="para-wrap">Know More</x-hoverBtn>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
