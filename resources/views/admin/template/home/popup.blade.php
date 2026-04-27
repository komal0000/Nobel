@foreach ($popups as $popup)
    @if ($popup->is_active)
        <div class="modal fade homepageModal" id="homepageModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="w-100 img-fluid" src="{{ asset($popup->image) }}" alt="">
                        <br>
                        @if ($popup->download_file)
                            <div class="mt-3 text-center">
                                <a href="{{ asset($popup->download_file) }}" class="btn btn-primary" download>
                                    <i class="bi bi-download"></i> Download File
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
    @endif
@endforeach
