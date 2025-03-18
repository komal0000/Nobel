@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.technology.index') }}">Technologies</a> /
    <span>Edit</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="title">Title <span style="color: red;">*</span></label>
            <input type="text" name="title" id="technology_title" class="form-control" value="{{ $technology->title }}"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="specialty_id">Speciality</label>
            <select name="specialty_id" id="specialty_id" class="form-control">
                @foreach ($specialities as $speciality)
                    <option value="{{ $speciality->id }}"
                        {{ $speciality->id == $technology->specialty_id ? 'selected' : '' }}>{{ $speciality->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="short_description">Short Description <span style="color: red;">*</span></label>
            <input type="text" name="short_description" id="technology_short_description" class="form-control"
                value="{{ $technology->short_description }}">
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
                    $sectionData = DB::table('technology_section_data')
                        ->where('technology_id', $technology->id)
                        ->where('technology_section_type_id', $type->id)
                        ->where('technology_section_id', $section->id)
                        ->first();
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
                                <div class="row mt-3" id="sectionData_{{ $type->id }}" >
                                    <h5 class="my-2">Section Data</h5>
                                    <div class="col-md-4 mb-3">
                                        <label for="section_image_{{ $type->id }}">Image <span style="color: red;">*</span></label>
                                        <input type="file" name="image" id="section_image_{{ $type->id }}" data-default-file="{{ Storage::url($sectionData->image) }}" class="form-control dropify"
                                            accept="image/*" required>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="section_title_{{ $type->id }}">Title <span style="color: red;">*</span></label>
                                                <input type="text" name="title" id="section_title_{{ $type->id }}" class="form-control" value="{{ $sectionData->title }}" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="section_short_description_{{ $type->id }}">Short Description <span style="color: red;">*</span></label>
                                                <textarea name="short_description" id="section_short_description_{{ $type->id }}" class="form-control" required>{{$sectionData->short_description}}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="section_long_description_{{ $type->id }}">Long Description</label>
                                                <textarea name="long_description" id="section_long_description_{{ $type->id }}" class="form-control">{{$sectionData->long_description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
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
        function UpdateAll(technology_id) {
            var formData = new FormData();
            formData.append("specialty_id", $("#specialty_id").val());
            formData.append("technology_title", $("#technology_title").val());
            formData.append("technology_short_description", $("#technology_short_description").val());
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
                var sectionData = $("#sectionData_" + typeId);
                if (sectionData.length) {
                    var sectionDataImageInput = sectionData.find("#section_image_" + typeId);
                    if (sectionDataImageInput.length && sectionDataImageInput[0].files[0]) {
                        formData.append("sections[" + typeId + "][section_image]", sectionDataImageInput[0].files[0]);
                    }
                    formData.append("sections[" + typeId + "][section_title]", sectionData.find("#section_title_" + typeId).val());
                    formData.append("sections[" + typeId + "][section_short_description]", sectionData.find("#section_short_description_" + typeId).val());
                    formData.append("sections[" + typeId + "][section_long_description]", sectionData.find("#section_long_description_" + typeId).val());
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
