<section id="single-service-elder">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Our Packages
        </div>
        <div class="package-list">
            <div class="package-slider">
                @foreach ($packages2 as $package)
                    <div class="each-package">
                        <div class="heading-sm">{{$package->title}}</div>
                        <div class="package-body">
                            <ul>
                                {!! $package->description !!}
                            </ul>
                        </div>
                        <div class="package-price">
                            <div class="price">Rs. {{$package->price}}</div>
                            <button data-package="{{$package->title}}" class="enroll-btn" data-bs-toggle="modal" data-bs-target="#enrollModal">
                                Enroll Now
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="enrollModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Full Name *" required>
                                <label for="name">Full Name *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" name="phoneNumber" placeholder="Phone Number *"
                                    required>
                                <label for="phoneNumber">Phone Number *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email Address *"
                                    required>
                                <label for="email">Email
                                    Address *</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <select name="package" class="form-select" id="floatingSelect">
                                    @foreach ($package2 as $package)
                                        <option value="{{$package->title}}">{{$package->title}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Select Package *</label>
                            </div>
                        </div>
                        <div class="col-12 submit-btn">
                            <button class="w-100" id="submit-callback">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
