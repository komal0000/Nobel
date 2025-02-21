@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.speciality.index') }}">Specialties</a> /
    <a href="{{ route('admin.speciality.gallery.index', ['speciality_id' => $speciality->id]) }}">Galleries</a> /
    <span>Items</span>
@endsection

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.speciality.gallery.item.itemindex', ['gallery_id' => $gallery_id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row" id="items-container">
                <div class="col-md-4">
                    <div class="item-group border p-3 mb-3 rounded">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="file" name="icon[]" class="form-control dropify" data-height="100" accept="image/*">
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
                        <button type="button" class="btn btn-danger remove-item mt-2">Remove</button>
                    </div>
                </div>
            </div>
            <button type="button" id="add-item" class="btn btn-primary mt-3">Add Another Item</button>
            <button type="submit" class="btn btn-success mt-3">Submit</button>
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
                                <input type="file" name="icon[]" class="form-control dropify" data-height="100" accept="image/*">
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
                            <button type="button" class="btn btn-danger remove-item mt-2">Remove</button>
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
            $(document).on('click', '.remove-item', removeItem);s
        });
    </script>
@endsection
