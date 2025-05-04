<section class="not-sure">
    <div class="banner-para">
        <h1 class="banner-title">
            Still Searching for the Right Position?
        </h1>
        <p>Let's Find Your Fit!</p>
        {{-- <button class="resume" type="button" data-bs-toggle="modal" data-bs-target="#resume-modal">Submit Your
            Resume</button> --}}
         <x-hoverBtn href="{{ route('jobs.jobcategory') }}">Find Job</x-hoverBtn>
    </div>
    <div class="banner-img">
        <picture>
            <img src="{{ asset('front/assets/img/career/not-sure.jpg') }}" alt="Not Sure">
        </picture>
    </div>
    <div class="modal fade " id="resume-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header p-0 pb-3 border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Full Name *" required>
                                <label for="name">Full Name *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" name="phoneNumber" placeholder="Phone Number *" required>
                                <label for="phoneNumber">Phone Number *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email Address *" required>
                                <label for="email" >Email
                                    Address *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="location" placeholder="Location*"
                                    required>
                                <label for="location">Location*</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-md-6 mb-3">
                                <label for="resumeFile">Upload File *</label>
                                <input type="file" name="resumeFile" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="submit-btn">
                                <button id="submit-resume">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
