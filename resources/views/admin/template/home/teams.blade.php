<div class="find-doc">
    <form>
        <div class="find-doc-form">
            <div class="select-wrap d-flex justify-content-center gap-2" style="margin-bottom: 20px;">
                <div class="find-doc-speciality-wrap">
                    <div class="default-speciality-wrap d-flex justify-content-between gap-5" onclick="showList()" style="cursor: pointer">
                        <span class="default-speciality-item d-inline-block text-truncate">All Specialities</span>
                        <div class="position-relative">
                            <span class="anchor-down-btn d-inline-block" style="border-color: #000"></span>
                        </div>
                    </div>
                    <div class="list-wrap" id="list-wrap" style="display: none;">
                        <input type="text" id="speciality-search" placeholder="Search Specialities..." class="form-control mb-2">
                        <ul class="find-doc-list-speciality" id="find-doc-speciality">
                            @foreach ($specialities as $specialty)
                                <li data-value="{{ $specialty->id }}">{{ $specialty->title }}</li>
                            @endforeach
                        </ul>
                        <input type="hidden" name="find-doc-speciality" id="find-doc-speciality-input">
                    </div>
                </div>
                <button type="submit" class="find-doc-btn">Go</button>
            </div>
        </div>
    </form>
</div>
