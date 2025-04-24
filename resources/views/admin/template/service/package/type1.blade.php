<section id="single-service-package">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Package List
        </div>
        <div class="filters">
            <div class="filter gender-filter">
                <div class="default-select default-select-gender">
                    <span class="name gender-name">
                        Choose Category
                    </span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="list gender-list">
                    <ul>
                        @foreach ($packageCategories as $category)
                        <li data-gender-target="{{ $category->title }}">{{ucfirst($category->title)}}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="packageGender" id="package-gender">
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
                    <div class="col-md-6 col-lg-4 col-xl-3 package-card-col" data-gender="{{ $category->title }}"
                        data-category="category-1">
                        <div class="package-card">
                            <div class="img-wrapper">
                                <img src="{{ Storage::url($package->image) }}" alt="Service Image">
                            </div>
                            <div class="body">
                                <div class="package-title">
                                    {{ $package->title }}
                                </div>
                                <span class="price">Rs. {{ $package->price }}</span>
                                <x-hoverBtn href="/single-package" class="para-wrap">Know More</x-hoverBtn>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

