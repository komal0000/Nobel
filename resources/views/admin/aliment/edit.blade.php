@extends('admin.layout.app')
@section('title')
    @if ($speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialities</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['speciality_id' => $parent->id]) }}">{{ $parent->title }}</a> /
        @endforeach

        <a href="{{ route('admin.aliment.index', ['speciality_id' => $speciality_id]) }}">Aliments</a> /
        <span>Edit</span>
    @else
        <a href="{{ route('admin.aliment.index') }}">Aliments</a> /
        <span>Edit</span>
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-md-7 mb-3">
            <div class="row">
                <div class="col-md-6">
                    <label for="aliment_icon">Icon 1:1<span style="color: red;">*</span></label>
                    <input type="file" class="form-control dropify" id="aliment_icon" name="icon" accept="image/*"
                        data-default-file="{{ Storage::url($aliment->icon) }}">
                </div>
                <div class="col-md-6">
                    <label for="aliment_single_page_image">Single Page Image <span style="color: red;">*</span></label>
                    <input type="file" class="form-control dropify" id="aliment_single_page_image"
                        name="single_page_image" accept="image/*"
                        data-default-file="{{ Storage::url($aliment->single_page_image) }}">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="col-md-12 mb-2">
                <label for="aliment_title">Title <span style="color: red;">*</span></label>
                <input type="text" class="form-control" id="aliment_title" name="title" value="{{ $aliment->title }}">
            </div>
            <div class="col-md-12 mb-3">
                <label for="aliment_short_description">Short Description <span style="color: red;">*</span></label>
                <textarea class="form-control " id="aliment_short_description" name="short_description">{{ $aliment->short_description }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($speciality_section_types as $type)
            @php
                $section = DB::table('aliment_sections')
                    ->where('aliment_id', $aliment->id)
                    ->where('aliment_section_type_id', $type->id)
                    ->first();
            @endphp
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-type" style="border-radius: 0px;">
                    <h2 class="accordion-header" id="panelsStayOpen-heading-{{ $type->id }}">
                        <button class="accordion-button collapsed d-flex align-types-center justify-content-between"
                            type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapse-{{ $type->id }}" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapse-{{ $type->id }}">
                            <div class="d-flex align-items-center gap-2">
                                <input type="checkbox" name="show_on_frontend" id="show_on_frontend_{{ $type->id }}"
                                    class="form-check-input" onclick="event.stopPropagation();"
                                    {{ $section && $section->show_on_frontend ? 'checked' : '' }}>
                                <span>{{ $type->title }}</span>
                            </div>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse-{{ $type->id }}" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-heading-{{ $type->id }}">
                        <div class="accordion-body" style="background: white">
                            <div class="row">
                                <input type="hidden" name="type_id" id="type_id_{{ $type->id }}"
                                    value="{{ $type->id }}">
                                <div class="col-md-4 mb-3">
                                    <label for="image_{{ $type->id }}">Image</label>
                                    <input type="file" name="image" id="image_{{ $type->id }}"
                                        class="form-control dropify" accept="image/*"
                                        data-default-file="{{ $section && $section->image ? Storage::url($section->image) : '' }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title_{{ $type->id }}">Title <span style="color: red;">*</span>
                                            </label>
                                            <input type="text" name="title" id="title_{{ $type->id }}"
                                                class="form-control" value="{{ $section ? $section->title : '' }}">
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="description_{{ $type->id }}">Description <span
                                                    style="color: red;">*</span></label>
                                            <textarea name="description" id="description_{{ $type->id }}" class="form-control">{{ $section ? $section->description : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-12 mt-3 d-flex justify-content-end">
            <button class="btn btn-primary" onclick="updateAll({{ $aliment->id }})">
                Update
            </button>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function updateAll(aliment_id) {
            var formData = new FormData();
            formData.append("aliment_id", "{{ $aliment->id }}");
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

            axios.post("{{ route('admin.aliment.edit', ['aliment_id' => '_id_']) }}".replace('_id_', aliment_id),
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
                    console.error('Update Error:', error);
                });
        }
    </script>
@endsection
