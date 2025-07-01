@extends('admin.layout.app')
@section('title')
    @if ($parent_speciality_id)
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        @php
            $parents = \App\Helper::getSpecialityRoutes($parent_speciality_id);
        @endphp
        @foreach ($parents as $parent)
            <a href="{{ route('admin.speciality.index', ['parent_speciality_id' => $parent->id]) }}">{{ $parent->title }}</a>
            /
        @endforeach
        <span>Sub Specialties</span>/
        <a
            href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id, 'parent_speciality_id' => $parent_speciality_id]) }}">Teams</a>
        /
        <span> {{ $specialityGallery->title }} </span> /
        <span>Items</span>
    @else
        <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
        <span>{{ $speciality->title }}</span> /
        <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id]) }}">Teams</a> /
        <span> {{ $specialityGallery->title }} </span> /
        <span>Items</span>
    @endif
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-end">
            <div class="col-md-4 d-flex justify-content-end">
                <button type="button" id="add-item" class="btn btn-primary"
                    onclick="addItem({{ $specialityGallery->id }})">Add Item</button>
            </div>
        </div>

        <div class="row" id="items-container">
            @foreach ($galleryItems as $item)
                <div class="col-md-4">
                    <div class="item-group border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="icon_{{ $item->id }}">Icon <span style="color: red;">*</span> </label>
                            <input type="file" name="icon" class="form-control dropify" id="icon_update_{{ $item->id }}"
                                data-height="100" data-default-file="{{ asset($item->icon) }}" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="title_{{ $item->id }}">Title <span style="color: red;">*</span></label>
                            <input type="text" name="title" class="form-control" id="title_update_{{ $item->id }}"
                                placeholder="Enter title" value="{{ $item->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description_{{ $item->id }}">Description (25-30 words)</label>
                            <textarea name="description" class="form-control" id="description_update_{{ $item->id }}" rows="3"
                                placeholder="Enter description">{!! old('description', $item->description) !!}</textarea>
                        </div>
                        <a href="{{ route('admin.speciality.gallery.item.delete', ['item_id' => $item->id]) }}"
                            class="btn btn-sm btn-danger">Delete</a>
                        <button onclick="EditData({{ $item->id }})" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </div>
            @endforeach
            <div class="col-md-4">
                <div class="item-group border p-3 mb-3 rounded">
                    <div class="form-group">
                        <label for="icon">Icon <span style="color: red;">*</span></label>
                        <input type="file" name="icon" class="form-control dropify" data-height="100" id="icon"
                            accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="title">Title <span style="color: red;">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description (25-30 words) <span style="color: red;">*</span></label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                    <button class="btn btn-primary btn-sm"
                        onclick="saveItem(event, {{ $specialityGallery->id }})">Save</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $(document).on('click', '.remove-item', function() {
                $(this).closest('.col-md-4').remove();
            });
        });

        function addItem(id) {
            var itemGroup = `
              <div class="col-md-4">
                <div class="item-group border p-3 mb-3 rounded">
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="file" name="icon" class="form-control dropify" data-height="100"
                            accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description (25-30 words)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                    <button class="btn btn-primary btn-sm" onclick="saveItem(event, ${id})">Save</button>
                </div>
            </div>
            `;
            $('#items-container').append(itemGroup);
            $('.dropify').dropify();
        }

        function EditData(id) {
            var formData = new FormData();
            formData.append('title', $(`#title_update_${id}`).val());
            formData.append('description', $(`#description_update_${id}`).val());
            var icon = $(`#icon_update_${id}`)[0].files[0];
            if (icon) {
                formData.append('icon', icon);
            }
            formData.append('_token', '{{ csrf_token() }}');

            axios.post("{{ route('admin.speciality.gallery.item.edit', ['item_id' => '__ID__']) }}".replace('__ID__',
                    id), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    location.reload();
                })
                .catch(function(error) {
                    alert('Error updating item');
                    console.error(error);
                });
        }

        function saveItem(event, id) {
            const formData = new FormData();
            const itemGroup = event.target.closest('.item-group');
            formData.append('title', $(itemGroup).find('input[name="title"]').val());
            formData.append('description', $(itemGroup).find('textarea[name="description"]').val());
            const icon = $(itemGroup).find('input[name="icon"]')[0].files[0];
            if (icon) {
                formData.append('icon', icon);
            }
            formData.append('_token', '{{ csrf_token() }}');

            axios.post("{{ route('admin.speciality.gallery.item.index', ['gallery_id' => '__ID__']) }}".replace('__ID__',
                    id), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    if (response.data.success){
                        location.reload();
                    }
                }).catch(function(error) {
                    alert('Error saving item');
                    console.error(error);
                });
        }
    </script>
@endsection
