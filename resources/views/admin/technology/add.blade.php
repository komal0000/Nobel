@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.technology.index') }}">Technologies</a> /
    <span>Add</span>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="title">Title <span style="color: red;">*</span></label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="speciality_id">Speciality</label>
            <select name="speciality_id" id="speciality_id" class="form-control">
                @foreach ($specialities as $speciality)
                    <option value="{{ $speciality->id }}">{{ $speciality->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="short_description">Short Description <span style="color: red;">*</span></label>
            <input type="text" name="short_description" id="short_description" class="form-control">
        </div>
    </div>
    <div class="shadow mt-2 p-3">
        {{-- <div class="pb-2">
            <h4>Technology Sections</h4>
        </div> --}}
        <div class="row">
            @foreach ($technologySectionTypes as $type)
                <div class="accordion" id="accordionPanelsStayOpenExample">
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
                                    <input type="hidden" name="type_id" id="type_id" value="{{ $type->id }}">
                                    <div class="col-md-4 mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image_{{ $type->id }}"
                                            class="form-control dropify" accept="image/*">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="title">Title <span style="color: red;">*</span> </label>
                                                <input type="text" name="title" id="title_{{ $type->id }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="designType">Design Type</label>
                                                <select name="designType" id="designType" class="form-control">
                                                    <option value="1">Two Rows</option>
                                                    <option value="3">Three Rows</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="description">Description <span style="color: red;">*</span></label>
                                                <textarea name="description" id="description_{{ $type->id }}" class="form-control"></textarea>
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
        <button class="btn btn-primary" onclick="saveAll()">
            Save All
        </button>
    </div>
@endsection
@section('js')
    <script>
        function saveAll() {
            var formData = new FormData();
            formData.append("specialty_id", $("#specialty_id").val());
            formData.append("aliment_title", $("#aliment_title").val());
            formData.append("aliment_short_description", $("#aliment_short_description").val());
            var alimentIcon = $("#aliment_icon")[0].files[0];
            if (alimentIcon) {
                formData.append("aliment_icon", alimentIcon);
            }
            var alimentSinglePageImage = $("#aliment_single_page_image")[0].files[0];
            if (alimentSinglePageImage) {
                formData.append("aliment_single_page_image", alimentSinglePageImage);
            }

            $(".accordion-type").each(function() {
                var section = $(this);
                var typeId = section.find('input[name="type_id"]').val();
                formData.append("sections[" + typeId + "][title]", section.find("#title_" + typeId).val());
                formData.append("sections[" + typeId + "][description]", section.find("#description_" + typeId)
                    .val());
                var sectionImage = section.find("#image_" + typeId)[0].files[0];
                if (sectionImage) {
                    formData.append("sections[" + typeId + "][image]", sectionImage);
                }
                var checkbox = section.find('input[name="show_on_frontend"]');
                formData.append("sections[" + typeId + "][show_on_frontend]", checkbox.is(":checked") ? 1 : 0);
            });
            axios.post('{{ route('admin.aliment.add') }}', formData, {
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
                    console.error('Error:', error);
                });
        }
    </script>
@endsection
