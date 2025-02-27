@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
    <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id]) }}">Galleries</a> /
    <span>Items</span>
@endsection

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.speciality.gallery.item.index', ['gallery_id' => $gallery_id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-end">
                <div class="col-md-4 d-flex justify-content-end">
                    <button type="button" id="add-item" class="btn btn-primary">Add Item</button>
                </div>
            </div>

            <div class="row" id="items-container">
                @foreach ($galleryItems as $item)
                    <div class="col-md-4">
                        <div class="item-group border p-3 mb-3 rounded">
                            <div class="form-group">
                                <label for="icon">Icon </label>
                                <input type="file" name="icon" class="form-control dropify" id="icon"
                                    data-height="100" data-default-file="{{ Storage::url($item->icon) }}" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="title">Title </label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Enter title" value="{{ $item->title }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description </label>
                                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter description">{!! old('description', $item->description) !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="extra_data">Extra Data</label>
                                <input type="text" name="extra_data" class="form-control " id="extra_data"
                                    placeholder="Enter extra data" value="{{ $item->extra_data }}">
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
                            <input type="file" name="icon[]" class="form-control dropify" data-height="100"
                                accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="title">Title <span style="color: red;">*</span></label>
                            <input type="text" name="title[]" class="form-control" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span style="color: red;">*</span></label>
                            <textarea name="description[]" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="extra_data">Extra Data</label>
                            <input type="text" name="extra_data[]" class="form-control" placeholder="Enter extra data">
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success mt-3">Add</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();

            function addItem() {
                var itemGroup = `
                  <div class="col-md-4">
                    <div class="item-group border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="file" name="icon[]" class="form-control dropify" data-height="100"
                                accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title[]" class="form-control" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description[]" class="form-control" rows="3" placeholder="Enter description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="extra_data">Extra Data</label>
                            <input type="text" name="extra_data[]" class="form-control" placeholder="Enter extra data">
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                    </div>
                </div>
                `;
                $('#items-container').append(itemGroup);
                $('.dropify').dropify();
            }

            function removeItem(event) {
                $(this).closest('.col-md-4').remove();
            }

            $('#add-item').click(addItem);
            $(document).on('click', '.remove-item', removeItem);
        });

        function EditData(id) {
            var formData = new FormData();

            formData.append('title', $('#title').val());
            formData.append('description', $('#description').val());
            formData.append('extra_data', $('#extra_data').val());

            var icon = $('#icon')[0].files[0];
            if (icon) {
                formData.append('icon', icon);
            }

            axios.post("{{ route('admin.speciality.gallery.item.edit', ['item_id' => '__ID__']) }}".replace('__ID__',
                    id), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {})
                .catch(function(error) {
                    alert('Error updating item');
                    console.error(error);
                });
        }
    </script>
@endsection
