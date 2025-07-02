@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.technology.index') }}">Technologies</a> /
    <span>Add</span>
@endsection
@section('content')
    <form>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="technology_image">Image (960x720px or 1920x1440px) <span style="color: red">*</span></label>
                        <input type="file" name="technology_image" id="technology_image" class="form-control dropify" required
                            accept="image/*">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="technology_single_page_image">Singe Page Image (1920x480px) <span style="color: red">*</span></label>
                        <input type="file" name="technology_single_page_image" id="technology_single_page_image" class="form-control dropify" required
                            accept="image/*">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="col-md-12 mb-3">
                    <label for="technology_title">Title <span style="color: red;">*</span></label>
                    <input type="text" name="technology_title" id="technology_title" class="form-control" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="specialty_id">Speciality <span style="color: red;">*</span></label>
                    <select name="specialty_id" id="specialty_id" class="form-control" required>
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ $speciality->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="technology_short_description">Short Description (25-30 words) <span style="color: red;">*</span></label>
                    <textarea name="technology_short_description" id="technology_short_description"
                        class="form-control" required></textarea>
                </div>
            </div>
        </div>
        <div class="shadow mt-2 p-3">
            <div class="row">
                @foreach ($technologySectionTypes as $type)
                    <div class="accordion mb-3" id="accordionPanelsStayOpenExample_{{ $type->id }}">
                        <div class="accordion-type" style="border-radius: 0px;">
                            <h2 class="accordion-header" id="panelsStayOpen-heading-{{ $type->id }}">
                                <button class="accordion-button collapsed d-flex align-items-center justify-content-between"
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
                                            <label for="image_{{ $type->id }}">Image (500x500px or 1000x1000px)</label>
                                            <input type="file" name="image" id="image_{{ $type->id }}"
                                                class="form-control dropify" accept="image/*">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="title_{{ $type->id }}">Title <span
                                                            style="color: red;">*</span> </label>
                                                    <input type="text" name="title" id="title_{{ $type->id }}"
                                                        class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="designType_{{ $type->id }}">Design Type <span
                                                            style="color: red;">*</span></label>
                                                    <select name="designType" id="designType_{{ $type->id }}"
                                                        class="form-control" required>
                                                        <option value="1">Type 1</option>
                                                        <option value="2">Type 2</option>
                                                        <option value="3">Type 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="short_description_{{ $type->id }}">Short Description (25-30 words)
                                                        <span style="color: red;">*</span></label>
                                                    <textarea name="short_description" id="short_description_{{ $type->id }}" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-3 d-flex justify-content-end">
                                                <button type="button" class="btn btn-sm btn-primary btn-active" onclick="addSectionData(event, {{ $type->id }})">
                                                    Add Section Data
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3" id="sectionData_{{ $type->id }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex justify-content-end">
            <button type="button" class="btn btn-primary" onclick="saveAll()">
                Save All
            </button>
        </div>
    </form>
@endsection

@section('js')
    <script>
        function addSectionData(event, typeId) {
            event.preventDefault();
            const timestamp = Date.now();
            $("#sectionData_" + typeId).append(`
                <h5 class="my-2">Section Data</h5>
                <div class="col-md-4 mb-3">
                    <label for="section_image_${typeId}_${timestamp}">Image (500x500px or 1000x1000px)<span style="color: red;">*</span></label>
                    <input type="file" name="image" id="section_image_${typeId}_${timestamp}" class="form-control dropify" accept="image/*" required>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="section_title_${typeId}_${timestamp}">Title <span style="color: red;">*</span></label>
                            <input type="text" name="title" id="section_title_${typeId}_${timestamp}" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="section_short_description_${typeId}_${timestamp}">Short Description (25-30 words) <span style="color: red;">*</span></label>
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

        function saveAll() {
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

                var mainImageInput = section.find("#image_" + typeId);
                if (mainImageInput.length && mainImageInput[0].files[0]) {
                    formData.append("sections[" + typeId + "][image]", mainImageInput[0].files[0]);
                }
                var sectionDataContainer = $("#sectionData_" + typeId);
                if (sectionDataContainer.length) {
                    var sectionDataItems = sectionDataContainer.find(".section-data-item");
                    if (sectionDataItems.length === 0) {
                        var timestamps = new Set();
                        sectionDataContainer.find('input[id^="section_"], textarea[id^="section_"]').each(function() {
                            var idParts = $(this).attr('id').split('_');
                            if (idParts.length >= 3) {
                                timestamps.add(idParts[idParts.length - 1]);
                            }
                        });
                        timestamps.forEach(function(timestamp, index) {
                            var sectionImageInput = sectionDataContainer.find("#section_image_" + typeId + "_" + timestamp);
                            if (sectionImageInput.length && sectionImageInput[0].files[0]) {
                                formData.append("sections[" + typeId + "][section_data][" + index + "][image]", sectionImageInput[0].files[0]);
                            }

                            var sectionTitle = sectionDataContainer.find("#section_title_" + typeId + "_" + timestamp).val();
                            var sectionShortDesc = sectionDataContainer.find("#section_short_description_" + typeId + "_" + timestamp).val();
                            var sectionLongDesc = sectionDataContainer.find("#section_long_description_" + typeId + "_" + timestamp).val();
                            formData.append("sections[" + typeId + "][section_data][" + index + "][title]", sectionTitle || "");
                            formData.append("sections[" + typeId + "][section_data][" + index + "][short_description]", sectionShortDesc || "");
                            formData.append("sections[" + typeId + "][section_data][" + index + "][long_description]", sectionLongDesc || "");
                        });
                    }
                }
            });

            axios.post('{{ route('admin.technology.add') }}', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    if (response.data.success) {
                        sessionStorage.setItem('success', 'Aliment updated successfully');
                        location.reload();
                    }
                })
                .catch(function(error) {
                    console.error("Error:", error);
                });
        }
    </script>
@endsection
