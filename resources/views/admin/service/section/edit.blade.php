@extends('admin.layout.app')
@section('title')
    <a href="{{ route('admin.service.index') }}">Services</a> /
    <span>{{$service->title}}</span> /
    <a href="{{ route('admin.service.section.index', ['service_id' => $service->id]) }}">Sections</a> /
    <span>Edit</span>
@endsection
@section('content')
    <form action="{{ route('admin.service.section.edit', ['section_id' => $section->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control dropify" data-default-file="{{ asset($section->image) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12 mb-3">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $section->title }}" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="image_placement">Image Placement</label>
                    <select name="image_placement" id="image_placement" class="form-control"
                        onchange="showDescription(this.value)">
                        <option value="left" {{ $section->image_placement == 'left' ? 'selected' : '' }}>Left</option>
                        <option value="right" {{ $section->image_placement == 'right' ? 'selected' : '' }}>Right</option>
                        <option value="center" {{ $section->image_placement == 'center' ? 'selected' : '' }}>Center</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 mb-3" id="short_desc1">
                <label for="short_desc1">Description 1 (Use Unordered List) <span style="color: red;">*</span></label>
                <textarea name="short_desc1" id="short_desc1" class="form-control summernote" rows="3" required>{{ $section->short_desc1 }}</textarea>
            </div>
            <div class="col-md-6 mb-3" id="short_desc2">
                <label for="short_desc2">Description 2 (Use Unordered List)</label>
                <textarea name="short_desc2" id="short_desc2" class="form-control summernote" rows="3">{{ $section->short_desc2 }}</textarea>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var initialValue = $('#image_placement').val();
            showDescription(initialValue);
        });

        function showDescription(value) {
            console.log(value);
            if (value == 'left' || value == 'right') {
                $('#short_desc1').show();
                $('#short_desc2').hide();
            } else if (value == 'center') {
                $('#short_desc1').show();
                $('#short_desc2').show();
            }
        }
    </script>
@endsection
