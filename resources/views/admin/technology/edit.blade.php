@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.technology.index') }}">Technologies</a> /
    <span>Edit</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="technology_image">Image 4:2 <span style="color: red">*</span></label>
                    <input type="file" name="technology_image" id="technology_image" class="form-control dropify"
                        accept="image/*" data-default-file="{{ Storage::url($technology->image) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="technology_single_page_image">Single Page Image 4:1 <span style="color: red">*</span></label>
                    <input type="file" name="technology_single_page_image" id="technology_single_page_image"
                        class="form-control dropify" data-default-file="{{ Storage::url($technology->single_page_image) }}"
                        required accept="image/*">
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="col-md-12 mb-3">
                <label for="technology_title">Title <span style="color: red;">*</span></label>
                <input type="text" name="technology_title" id="technology_title" class="form-control"
                    value="{{ $technology->title }}" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="specialty_id">Speciality <span style="color: red;">*</span></label>
                <select name="specialty_id" id="specialty_id" class="form-control" required>
                    @foreach ($specialities as $speciality)
                        <option value="{{ $speciality->id }}"
                            {{ $speciality->id == $technology->specialty_id ? 'selected' : '' }}>
                            {{ $speciality->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="technology_short_description">Short Description <span style="color: red;">*</span></label>
                <textarea name="technology_short_description" id="technology_short_description" class="form-control" required>{{ $technology->short_description }}</textarea>
            </div>
        </div>
    </div>
    <div class="shadow mt-2 p-3">
        <div class="row">
            @foreach ($technologySectionTypes as $type)
                @php
                    $section = DB::table('technology_sections')
                        ->where('technology_id', $technology->id)
                        ->where('technology_section_type_id', $type->id)
                        ->first();
                    $sectionDatas = DB::table('technology_section_data')
                        ->where('technology_id', $technology->id)
                        ->where('technology_section_type_id', $type->id)
                        ->where('technology_section_id', $section->id)
                        ->get();
                @endphp
                <div class="accordion mb-3" id="accordionPanelsStayOpenExample">
                    <div class="accordion-type" style="border-radius: 0px;">
                        <h2 class="accordion-header" id="panelsStayOpen-heading-{{ $type->id }}">
                            <button class="accordion-button collapsed d-flex align-types-center justify-content-between"
                                type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse-{{ $type->id }}" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapse-{{ $type->id }}">
                                <div class="d-flex align-items-center gap-2">
                                    <span>{{ $type->title }}</span>
                                </div>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapse-{{ $type->id }}" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-heading-{{ $type->id }}">
                            <div class="accordion-body" style="background: white">
                                <div class="row">
                                    <h5 class="my-2">Section</h5>
                                    <input type="hidden" name="type_id" id="type_id" value="{{ $type->id }}">
                                    <div class="col-md-4 mb-3">
                                        <label for="image">Image <span style="color: red;">*</span></label>
                                        <input type="file" name="image" id="image_{{ $type->id }}"
                                            class="form-control dropify" accept="image/*"
                                            data-default-file="{{ Storage::url($section->image) }}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="title">Title <span style="color: red;">*</span> </label>
                                                <input type="text" name="title" id="title_{{ $type->id }}"
                                                    class="form-control" value="{{ $section->title }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="designType">Design Type <span
                                                        style="color: red;">*</span></label>
                                                <select name="designType" id="designType_{{ $type->id }}"
                                                    class="form-control">
                                                    <option value="1"
                                                        {{ $section->design_type == 1 ? 'selected' : '' }}>
                                                        Type 1</option>
                                                    <option value="2"
                                                        {{ $section->design_type == 2 ? 'selected' : '' }}>
                                                        Type 2</option>
                                                    <option value="3"
                                                        {{ $section->design_type == 3 ? 'selected' : '' }}>
                                                        Type 3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="short_description">Short Description <span
                                                        style="color: red;">*</span></label>
                                                <textarea name="short_description" id="short_description_{{ $type->id }}" class="form-control">{{ $section->short_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3 d-flex justify-content-end">
                                        <button type="button" class="btn btn-sm btn-primary btn-active"
                                            onclick="addSectionData(event, {{ $type->id }})">
                                            Add Section Data
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-3" id="sectionData_{{ $type->id }}">
                                    @foreach ($sectionDatas as $sectionData)
                                        <h5 class="my-2">Section Data</h5>
                                        <div class="row section-data-item">
                                            <div class="col-md-4 mb-3">
                                                <label for="section_image_{{ $type->id }}_{{ time() }}">Image
                                                    <span style="color: red;">*</span></label>
                                                <input type="file" name="image"
                                                    id="section_image_{{ $type->id }}_{{ time() }}"
                                                    data-default-file="{{ Storage::url($sectionData->image) }}"
                                                    class="form-control dropify" accept="image/*">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label
                                                            for="section_title_{{ $type->id }}_{{ time() }}">Title
                                                            <span style="color: red;">*</span></label>
                                                        <input type="text" name="title"
                                                            id="section_title_{{ $type->id }}_{{ time() }}"
                                                            class="form-control" value="{{ $sectionData->title }}">
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label
                                                            for="section_short_description_{{ $type->id }}_{{ time() }}">Short
                                                            Description <span style="color: red;">*</span></label>
                                                        <textarea name="short_description" id="section_short_description_{{ $type->id }}_{{ time() }}"
                                                            class="form-control">{{ $sectionData->short_description }}</textarea>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label
                                                            for="section_long_description_{{ $type->id }}_{{ time() }}">Long
                                                            Description</label>
                                                        <textarea name="long_description" id="section_long_description_{{ $type->id }}_{{ time() }}"
                                                            class="form-control">{{ $sectionData->long_description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-12 mt-3 d-flex justify-content-end">
        <button class="btn btn-primary" onclick="UpdateAll({{ $technology_id }})">
            Update All
        </button>
    </div>
@endsection
@section('js')
    <script>
         function addSectionData(event, typeId) {
            event.preventDefault();
            const timestamp = Date.now();
            $("#sectionData_" + typeId).append(`
                <h5 class="my-2">Section Data</h5>
                <div class="col-md-4 mb-3">
                    <label for="section_image_${typeId}_${timestamp}">Image <span style="color: red;">*</span></label>
                    <input type="file" name="image" id="section_image_${typeId}_${timestamp}" class="form-control dropify" accept="image/*" required>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="section_title_${typeId}_${timestamp}">Title <span style="color: red;">*</span></label>
                            <input type="text" name="title" id="section_title_${typeId}_${timestamp}" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="section_short_description_${typeId}_${timestamp}">Short Description <span style="color: red;">*</span></label>
                            <textarea name="short_description" id="section_short_description_${typeId}_${timestamp}" class="form-control" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="section_long_description_${typeId}_${timestamp}">Long Description</label>
                            <textarea name="long_description" id="section_long_description_${typeId}_${timestamp}" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            `);
            $('.dropify').dropify();
        }
        function UpdateAll(technology_id) {
            var formData = new FormData();
            formData.append("specialty_id", $("#specialty_id").val());
            formData.append("technology_title", $("#technology_title").val());
            formData.append("technology_short_description", $("#technology_short_description").val());
            var technologyImage = $("#technology_image")[0].files[0];
            var technologySinglePageImage = $("#technology_single_page_image")[0].files[0];
            if (technologyImage) {
                formData.append("technology_image", technologyImage);
            }
            if (technologySinglePageImage) {
                formData.append("technology_single_page_image", technologySinglePageImage);
            }
            $(".accordion-type").each(function() {
                var section = $(this);
                var typeId = section.find('input[name="type_id"]').val();
                formData.append("sections[" + typeId + "][title]", section.find("#title_" + typeId).val());
                formData.append("sections[" + typeId + "][short_description]", section.find("#short_description_" +
                    typeId).val());
                formData.append("sections[" + typeId + "][designType]", section.find("#designType_" + typeId)
                    .val());
                var sectionImage = section.find("#image_" + typeId)[0].files[0];
                if (sectionImage) {
                    formData.append("sections[" + typeId + "][image]", sectionImage);
                };

                var sectionDataContainer = $("#sectionData_" + typeId);
                if (sectionDataContainer.length) {
                    var sectionDataItems = sectionDataContainer.find('.section-data-item');
                    var timestamps = new Set();

                    if (sectionDataItems.length) {
                        sectionDataItems.each(function(index) {
                            var item = $(this);
                            var imageInput = item.find('input[type="file"]');
                            if (imageInput.length && imageInput[0].files[0]) {
                                formData.append(`sections[${typeId}][section_data][${index}][image]`, imageInput[0].files[0]);
                            }

                            formData.append(`sections[${typeId}][section_data][${index}][title]`,
                                item.find('input[name="title"]').val());
                            formData.append(`sections[${typeId}][section_data][${index}][short_description]`,
                                item.find('textarea[name="short_description"]').val());
                            formData.append(`sections[${typeId}][section_data][${index}][long_description]`,
                                item.find('textarea[name="long_description"]').val());
                        });
                    } else {
                        sectionDataContainer.find('input[id^="section_"], textarea[id^="section_"]').each(function() {
                            var idParts = $(this).attr('id').split('_');
                            if (idParts.length >= 4) {
                                timestamps.add(idParts[idParts.length - 1]);
                            }
                        });

                        Array.from(timestamps).forEach(function(timestamp, index) {
                            var imageInput = sectionDataContainer.find(`#section_image_${typeId}_${timestamp}`);
                            if (imageInput.length && imageInput[0].files[0]) {
                                formData.append(`sections[${typeId}][section_data][${index}][image]`, imageInput[0].files[0]);
                            }

                            var sectionTitle = sectionDataContainer.find(`#section_title_${typeId}_${timestamp}`).val() || "";
                            var sectionShortDesc = sectionDataContainer.find(`#section_short_description_${typeId}_${timestamp}`).val() || "";
                            var sectionLongDesc = sectionDataContainer.find(`#section_long_description_${typeId}_${timestamp}`).val() || "";

                            formData.append(`sections[${typeId}][section_data][${index}][title]`, sectionTitle);
                            formData.append(`sections[${typeId}][section_data][${index}][short_description]`, sectionShortDesc);
                            formData.append(`sections[${typeId}][section_data][${index}][long_description]`, sectionLongDesc);
                        });
                    }
                }
            });
            axios.post("{{ route('admin.technology.edit', ['technology_id' => '_ID_']) }}".replace('_ID_', technology_id),
                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                .then(function(response) {
                    if (response.data.success) {
                        location.reload();
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
