@extends('admin.layout.app')
@section('title')
    <span>Research Committee</span>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row justify-content-end">
            <div class="col-md-4 d-flex justify-content-end mb-2">
                <button type="button" id="add-item" class="btn btn-primary"
                    onclick="addItem()">Add Item</button>
            </div>
        </div>

        <div class="row" id="items-container">
            @foreach ($researchCommittees as $item)
                <div class="col-md-4">
                    <div class="item-group border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="icon_{{ $item->id }}">Image (360x240px) <span style="color: red;">*</span>
                            </label>
                            <input type="file" name="icon" class="form-control dropify"
                                id="icon_update_{{ $item->id }}" data-height="100"
                                data-default-file="{{ asset($item->icon) }}" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="name_{{ $item->id }}">Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" class="form-control" id="name_update_{{ $item->id }}"
                                placeholder="Enter Name" value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                            <label for="post_{{ $item->id }}">Post <span style="color: red;">*</span></label>
                            <input type="text" name="post" class="form-control" id="post_update_{{ $item->id }}"
                                placeholder="Enter post" value="{{ $item->post }}">
                        </div>
                        <a href="{{ route('admin.setting.delResearchCommittee', ['id' => $item->id]) }}"
                            class="btn btn-sm btn-danger">Delete</a>
                        <button onclick="EditData({{ $item->id }})" class="btn btn-sm btn-primary">Update</button>
                    </div>
                </div>
            @endforeach
            <div class="col-md-4">
                <div class="item-group border p-3 mb-3 rounded">
                    <div class="form-group">
                        <label for="icon">Image (360x240px) <span style="color: red;">*</span></label>
                        <input type="file" name="icon" class="form-control dropify" data-height="100" id="icon"
                            accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="name">Name <span style="color: red;">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="post">Post <span style="color: red;">*</span></label>
                        <input type="text" name="post" class="form-control" placeholder="Enter post">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                    <button class="btn btn-primary btn-sm" onclick="saveItem(event)">Save</button>
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

        function addItem() {
            var itemGroup = `
              <div class="col-md-4">
                <div class="item-group border p-3 mb-3 rounded">
                    <div class="form-group">
                        <label for="icon">Image (360x240px)</label>
                        <input type="file" name="icon" class="form-control dropify" data-height="100"
                            accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="post">Post</label>
                        <input type="text" name="post" class="form-control" placeholder="Enter post">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                    <button class="btn btn-primary btn-sm" onclick="saveItem(event)">Save</button>
                </div>
            </div>
            `;
            $('#items-container').append(itemGroup);
            $('.dropify').dropify();
        }

        function EditData(id) {
            var formData = new FormData();
            formData.append('name', $(`#name_update_${id}`).val());
            formData.append('post', $(`#post_update_${id}`).val());
            var icon = $(`#icon_update_${id}`)[0].files[0];
            if (icon) {
                formData.append('icon', icon);
            }
            formData.append('_token', '{{ csrf_token() }}');

            axios.post("{{ route('admin.setting.researchCommitteeUpdate', ['id' => '__ID__']) }}".replace('__ID__',
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

        function saveItem(event) {
            const formData = new FormData();
            const itemGroup = event.target.closest('.item-group');
            formData.append('name', $(itemGroup).find('input[name="name"]').val());
            formData.append('post', $(itemGroup).find('input[name="post"]').val());
            const icon = $(itemGroup).find('input[name="icon"]')[0].files[0];
            if (icon) {
                formData.append('icon', icon);
            }
            formData.append('_token', '{{ csrf_token() }}');

            axios.post("{{ route('admin.setting.researchCommittee') }}", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    if (response.data.success) {
                        location.reload();
                    }
                }).catch(function(error) {
                    alert('Error saving item');
                    console.error(error);
                });
        }
    </script>
@endsection
