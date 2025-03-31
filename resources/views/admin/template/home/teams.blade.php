<div class="find-doc">
    <form>
        <div class="find-doc-form">
            <div class="select-wrap d-flex justify-content-center gap-2 mb-4">
                <div class="find-doc-speciality-wrap">
                    <div class="default-speciality-wrap d-flex justify-content-between gap-5 cursor-pointer" onclick="showList()">
                        <div class="position-relative">
                            <span class="anchor-down-btn d-inline-block border-dark"></span>
                        </div>
                    </div>
                    <div class="list-wrap" id="list-wrap" style="display: none;">
                        <input type="text" id="speciality-search" placeholder="Search Specialities..." class="form-control mb-2">
                        <ul class="find-doc-list-speciality" id="find-doc-speciality" style="overflow: unset;">
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
